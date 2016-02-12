<?php

include_once dirname(__FILE__) . '/CustomPhivolcsCsvConverter.php';

class CustomPhivolcsTiltCsvConverter extends CustomPhivolcsCsvConverter {

    protected $rad;
    protected $tan;
    protected $temperature;

    public function __construct() {
        parent::__construct();
    }

    public function generateXmlFiles() {
        if ($this->getOwner1() == "")
            throw new Exception("There is no owner.");
        $owner1_tag = "owner1=\"" . $this->getOwner1() . "\" ";
        $owner2_tag = $this->getOwner2() == "" ? "" : "owner2=\"" . $this->getOwner2() . "\" ";
        $owner3_tag = $this->getOwner3() == "" ? "" : "owner3=\"" . $this->getOwner3() . "\" ";
        $station = $this->getStation();
        $station_tag = "station=\"$station\" ";
        $instrument = $this->getInstrument();
        $instrument_tag = "instrument=\"" . $instrument . "\" ";
        $wovomlPrefix = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n <wovoml xmlns=\"http://www.wovodat.org\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" version=\"1.1.0\" xsi:schemaLocation=\"http://www.wovodat.org/WOVOdatV1.xsd\">\r\n<Data>\r\n<Deformation>\r\n";
        $wovomlPostfix = "</ElectronicTiltDataset>\r\n</Deformation>\r\n</Data>\r\n</wovoml>";
        $filePath = self::TRANSLATION_FOLDER . "translated/";
        $count = 0;
        $current = date_create(date_format($this->startTime, "m/d/Y H:i:s"));
        $code_tag = "";
        $content = "";
        $numberOfRecords = $this->numberOfRecords;
        $start = 0;
        $end = 0;
        $i = 0;
        while (true) {
            $fileName = $this->fileName . "_" . $count . ".xml";
            $file = $filePath . $fileName;
            $temp_xml = fopen($file, "w");
            fwrite($temp_xml, $wovomlPrefix);
            fwrite($temp_xml, "<ElectronicTiltDataset>\r\n");
            if ($temp_xml == false) {
                throw new Exception("Cannot create the xml file");
            }
            $start = $count * $this->outputSize;
            $end = $start + $this->outputSize;
            if ($end >= $this->numberOfRecords)
                $end = $this->numberOfRecords;
            for (; $i < $end && ($this->rad[$i] != "NA" || $this->tan[$i] != "NA"); $i++) {
                $code_tag = "code=\"" . $station . "_" . date_format($current, "ymdHis") . "\" ";
                $content = $content . "<ElectronicTilt " . $code_tag . $instrument_tag . $owner1_tag . $owner2_tag . $owner3_tag . $station_tag . ">\n";
                $content = $content . "<measTime>" . date_format($current, "Y-m-d H:i:s") . "</measTime>\n";
                $content = $content . "<sampleRate>" . ($this->sampleRate * 60) . "</sampleRate>\n";
                $this->rad[$i] . "<br/>";
                if ($this->rad[$i] != "NA") {
                    $content = $content . "<tilt1>" . floatval($this->rad[$i]) . "</tilt1>\n";
                }
                if ($this->tan[$i] != "NA") {
                    $content = $content . "<tilt2>" . floatval($this->tan[$i]) . "</tilt2>\n";
                }

                $content = $content . "<processed>P</processed>\n";
			    $content = $content . "<temperature>" . floatval($this->temperature[$i]) . "</temperature>\n";	
                $content = $content . "</ElectronicTilt>\n";
                fwrite($temp_xml, $content);
                $content = "";
                $current->modify("+$this->sampleRate minutes");
            }
            fwrite($temp_xml, $wovomlPostfix);
            fclose($temp_xml);
            $count++;
            if ($end == $this->numberOfRecords)
                break;
        }
        $zip = new ZipArchive();
        $fileName = $this->fileName . ".zip";
        $resource = $zip->open($filePath . $fileName, ZipArchive::CREATE || ZipArchive::OVERWRITE);
        $this->xmlLink = $filePath . $fileName;
        for ($i = 0; $i < $count; $i++) {
            $fileName = $this->fileName . "_" . $i . ".xml";
            $file = $filePath . $fileName;
            $zip->addFile($file, $fileName);
        }
        $zip->close();
        for ($i = 0; $i < $count; $i++) {
            $fileName = $this->fileName . "_" . $i . ".xml";
            $file = $filePath . $fileName;
            unlink($file);
        }
    }

    public function generateJsonData() {
        $output = Array();
        $output['downloadLink'] = $this->xmlLink;
        $output['startTime'] = $this->startTime;
        $output['outputSize'] = $this->outputSize;
        $output['sampleRate'] = $this->sampleRate;
        $output['numberOfRecords'] = $this->numberOfRecords;
        $output['files'] = $this->files;
        $output['xComponent'] = $this->rad;
        $output['yComponent'] = $this->tan;
        echo json_encode($output);
    }

    public function convert($fileNames) {
        $this->rad = Array();
        $this->tan = Array();
        $this->temperature = Array();
        $this->numberOfRecords = 0;
        $this->files = Array();
        set_time_limit(100);
        ini_set("upload_max_filesize", "20M");
        ini_set("post_max_filesize", "50M");
        date_default_timezone_set("UTC");
        // moving the uploaded file to pre-translation folder
        $this->moveFile($fileNames);
        $tiltRadFile = self::TRANSLATION_FOLDER . "to_be_translated/" . $_FILES[$fileNames]['name'][0];
        $this->fileName = $this->getFileName($_FILES[$fileNames]['name'][0]);
        $this->files[0] = Array();
        $this->files[0]['fileName'] = $_FILES[$fileNames]['name'][0];
        $this->files[0]['size'] = $_FILES[$fileNames]['size'][0] / 1024;
        $tiltTangFile = self::TRANSLATION_FOLDER . "to_be_translated/" . $_FILES[$fileNames]['name'][1];
        $this->files[1] = Array();
        $this->files[1]['fileName'] = $_FILES[$fileNames]['name'][1];
        $this->files[1]['size'] = $_FILES[$fileNames]['size'][1] / 1024;
        $lineRad = file($tiltRadFile);
        if ($lineRad == false)
            throw new Exception("Cannot open tilt rad file");
        $this->files[0]['rows'] = count($lineRad);
        $lineTan = file($tiltTangFile);
        if ($lineTan == false)
            throw new Exception("Cannot open tilt Y file");
        $this->files[1]['rows'] = count($lineTan);
        // to prevent the case where the data have jumps
        $length = $this->getMin(sizeof($lineRad), sizeof($lineTan));
        $i = 0;
        for (; $i < $length; $i++) {
            if ($lineRad[$i][0] == "#" && $lineTan[$i][0] == "#")
                continue;
            else if ($lineRad[$i][0] != "#" && $lineTan[$i][0] != "#")
                break;
            else
                throw new Exception("Data format is not correct, number of comment lines in two files are not identical.<br/> Please check file: " . $_FILES[$fileNames]['name'][0] . " or file: " . $_FILES[$fileNames]['name'][1]);
        }
        if ($i == $length)
            throw new Exception("No data is read from the input files.<br/>Please fix the input file according to PHIVOLCS format for tilt data");

        // this is to prevent the unstable situation of the data, if there is no data
        // at the place that it is supposed to be, the code will at the line with the content such as
        // Y-m-dTH:i:s NA NA NA NA NA NA NA
        // this will be treated as empty string "" when written to the xml file format.
        $minInterval = $this->getMin($this->getMinInterval($lineRad, $i), $this->getMinInterval($lineTan, $i));
        $lineRad = $this->padValue($lineRad, $i, $minInterval);
        $lineTan = $this->padValue($lineTan, $i, $minInterval);

        $this->startTime = $this->getDate($lineRad[$i]);
        $nextTimeValue = 0;
        $this->rad[$this->numberOfRecords] = $this->getValue($lineRad[$i]);
        $this->temperature[$this->numberOfRecords] = $this->getTemperature($lineRad[$i]);
        $this->tan[$this->numberOfRecords++] = $this->getValue($lineTan[$i]);
        $nextTimeValue = $this->getTime($lineRad[$i]);
        $step = $this->sampleRate * 60 / $minInterval;
        $nextTimeValue->modify("+$this->sampleRate minutes");
        $i = $i + $step;
        for (; $i < $length; $i = $i + $step) {
            $currentTime = $this->getTime($lineRad[$i]);
            if ($currentTime->getTimestamp() < $nextTimeValue->getTimestamp())
                continue;
            $this->rad[$this->numberOfRecords] = $this->getValue($lineRad[$i]);
            $this->temperature[$this->numberOfRecords] = $this->getTemperature($lineRad[$i]);
            $this->tan[$this->numberOfRecords++] = $this->getValue($lineTan[$i]);
            $nextTimeValue->modify("+$this->sampleRate minutes");
        }
    }

    private function getTemperature($line) {
        $values = $this->explode($line, "\r, ");
        return $values[7];
    }

    // this function is to prevent the situation when there is no data for a specific time
    private function getValue($line) {
        $values = $this->explode($line, "\r, ");
        return $values[5];
    }

    private function padValue($lines, $start, $minInterval) {
        $new = "";
        $fixLines = Array();
        $length = count($lines);
        $current = $this->getTime($lines[$start]);
        for (; $start < $length; $start++) {
            if ($this->getTime($lines[$start]) == $current) {
                array_push($fixLines, $lines[$start]);
            } else {
                $new = date_format($current, "Y-m-d") . "T" . date_format($current, "h:i:s") . " NA NA NA NA NA NA NA";
                array_push($fixLines, $new);
                $start--;
            }
            $current->modify("+$minInterval seconds");
        }
        return $fixLines;
    }

    protected function getTime($line) {
        $values = $this->explode($line, "\r, ");
        return date_create($values[0]);
    }

    // this function will get the current date written in a line
    // format: 2009-01-23T21:20:57.10 1.610
    private function getDate($line) {
        $length = strlen($line);
        if ($length < 10)
            throw new Exception("This line is not a valid line: " . $line . "<br/>");
        $day = substr($line, 8, 2);
        $month = substr($line, 5, 2);
        $year = substr($line, 0, 4);
        $hour = substr($line, 11, 2);
        $minute = substr($line, 14, 2);
        $second = substr($line, 17, 2);
        return date_create("$month/$day/$year $hour:$minute:$second");
    }

}

?>