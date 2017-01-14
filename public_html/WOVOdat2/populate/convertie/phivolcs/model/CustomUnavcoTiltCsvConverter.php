<?php
include_once dirname(__FILE__).'/CustomUnavcoCsvConverter.php';

class CustomUnavcoTiltCsvConverter extends CustomUnavcoCsvConverter{
    // the array of x value
    protected $xComponent;
    // the array of y value
    protected $yComponent;
    // the number of records in a single xml file
    
    /*
     * convert the data stored in converter object into javascript json format,
     * this will be echoed directly to javascript code
     */
    public function generateJsonData(){
        $output = Array();
        $output['downloadLink'] = $this->xmlLink;
        //$output['startTime'] = date_format($this->startTime,"d-m-Y H:i:s");
        $output['startTime'] = $this->startTime;
        $output['outputSize'] = $this->outputSize;
        $output['sampleRate'] = $this->sampleRate;
        $output['numberOfRecords'] = $this->numberOfRecords;
        $output['files'] = $this->files;
        $output['xComponent'] = $this->xComponent;
        $output['yComponent'] = $this->yComponent;
        echo json_encode($output);
    }
    // generate the xml file from the current data
    public function generateXmlFiles(){
        if($this->getOwner1() == "")
            throw new Exception("There is no owner.");
        $owner1_tag = "owner1=\"".$this->getOwner1()."\" ";
        $owner2_tag = $this->getOwner2() == ""?"":"owner2=\"".$this->getOwner2()."\" ";
        $owner3_tag = $this->getOwner3() == ""?"":"owner3=\"".$this->getOwner3()."\" ";
        $station =$this->getStation();
        $station_tag = "station=\"$station\" ";
        $instrument = $this->getInstrument();
        $instrument_tag = "instrument=\"$instrument\" ";
        $wovomlPrefix = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<wovoml pubDate=\"2008-01-01 00:00:00\" version=\"1.1.0\" xmlns=\"http://www.wovodat.org\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.wovodat.org/WOVOdatV1.xsd\">\r\n<Data>\r\n<Deformation>\r\n";
        $wovomlPostfix = "</ElectronicTiltDataset>\r\n</Deformation>\r\n</Data>\r\n</wovoml>";
        $pubDate = $this->formatPubDate();
        $pubDate_tag = "pubDate=\"$pubDate\" ";
        $filePath = self::TRANSLATION_FOLDER . "translated/";
        $count = 0;
        $current = date_create(date_format($this->startTime,"m/d/Y H:i:s"));
        $code_tag = "";
        $content = "";
        $numberOfRecords = $this->numberOfRecords;
        $start = 0;
        $end = 0;
        $i = 0;
        while(true){
            $fileName = $this->fileName."_".$count.".xml";
            $file = $filePath . $fileName;
            $temp_xml = fopen($file, "w");
            fwrite($temp_xml, $wovomlPrefix);
            fwrite($temp_xml, "<ElectronicTiltDataset ".$instrument_tag.$owner1_tag.$owner2_tag.$owner3_tag.$pubDate_tag.$station_tag.">\r\n");
            if($temp_xml == false){
                throw new Exception("Cannot create the xml file");
            }
            $start = $count * $this->outputSize;
            $end = $start + $this->outputSize;
            if($end >= $this->numberOfRecords) $end = $this->numberOfRecords;
            for(;$i<$end;$i++){
                $code_tag = "code=\"".$station . "_Tilt" . date_format($current,"YmdHis")."\" ";
                $content = $content . "<ElectronicTilt ".$code_tag.$instrument_tag.$owner1_tag.$owner2_tag.$owner3_tag.$pubDate_tag.$station_tag.">\n";
                $content = $content . "<meansTime>".date_format($current,"Y-m-d H:i:s")."</meansTime>\n";
                $content = $content . "<sampleRate>".($this->sampleRate*60)."</sampleRate>\n";
                $content = $content . "<tilt1>".$this->xComponent[$i]."</tilt1>\n";
                $content = $content . "<tilt2>".$this->yComponent[$i]."</tilt2>\n";
                $content = $content . "<processed>R</processed>\n";
                $content = $content . "</ElectronicTilt>\n";
                fwrite($temp_xml,$content);
                $content = "";
                $current->modify("+$this->sampleRate minutes");
            }
            fwrite($temp_xml, $wovomlPostfix);
            fclose($temp_xml);
            $count++;
            if($end == $this->numberOfRecords) break;
        }
        $zip = new ZipArchive();
        $fileName = $this->fileName.".zip";
        $resource = $zip->open($filePath.$fileName, ZipArchive::CREATE || ZipArchive::OVERWRITE);
        $this->xmlLink = $filePath.$fileName;
        for($i = 0 ; $i < $count ;$i++){
            $fileName = $this->fileName."_".$i.".xml";
            $file = $filePath . $fileName;
            $zip->addFile($file,$fileName);
        }
        $zip->close();
        for($i = 0 ; $i < $count ;$i++){
            $fileName = $this->fileName."_".$i.".xml";
            $file = $filePath . $fileName;
            unlink($file);
        }
    }

    private function formatPubDate() {
        return date("Y-m-d H:i:s", mktime(0, 0, 0, 1, 1, intval(date_format($this->startTime,"Y"))+2));
    }
    // this function moves file from the upload folder to the designated folder
    // that the wovodat project is using.
    public function moveFile($fileNames){
        for($i = 0 ; $i < 2; $i++){
            $fileName = $_FILES[$fileNames]['name'][$i];
            $fileToRead = self::TRANSLATION_FOLDER . "to_be_translated/".$fileName;
            move_uploaded_file($_FILES['fname']['tmp_name'][$i],$fileToRead);
        }
    }
    // this function read the data in the upload files and store it to the protected
    // variables of this class
    public function convert($fileNames){
        $this->xComponent = Array();
        $this->yComponent = Array();
        $this->numberOfRecords = 0;
        $this->files = Array();
        set_time_limit(10);
        ini_set("memory_limit", "1024M");
        ini_set("upload_max_filesize", "20M");
        ini_set("post_max_filesize", "50M");
        date_default_timezone_set("UTC");
        // moving the uploaded file to pre-translation folder
        $this->moveFile($fileNames);

        $tiltXfile= self::TRANSLATION_FOLDER . "to_be_translated/".$_FILES[$fileNames]['name'][0];
        $this->fileName = $this->getFileName($_FILES[$fileNames]['name'][0]);
        $this->files[0] = Array();
        $this->files[0]['fileName'] = $_FILES[$fileNames]['name'][0];
        $this->files[0]['size'] = $_FILES[$fileNames]['size'][0]/1024;
        $tiltYfile= self::TRANSLATION_FOLDER . "to_be_translated/".$_FILES[$fileNames]['name'][1];
        $this->files[1] = Array();
        $this->files[1]['fileName'] = $_FILES[$fileNames]['name'][1];
        $this->files[1]['size'] = $_FILES[$fileNames]['size'][1]/1024;
        $line_x = file($tiltXfile);
        if($line_x == false)
            throw new Exception("Cannot open tilt X file");
        $line_y = file($tiltYfile);
        if($line_y == false)
            throw new Exception("Cannot open tilt Y file");

        $length = sizeof($line_x);
        // this code is under assumption that for UNAVCO electronic tilt data, the
        // information is continuous, there is no gap and jump inside the content of
        // the csv file.
        if($length != sizeof($line_y))
            throw new Exception("The length of both files are not the same.");
        $i = 0;
        for(;$i < $length;$i++){
            if($line_x[$i][0] == "#" && $line_y[$i][0] == "#") continue;
            else if($line_x[$i][0] != "#" && $line_y[$i][0] != "#") break;
            else
                throw new Exception("Data format is not correct, number of comment lines in two files are not identical.<br/> Please check file: " . $_FILES[$fileNames]['name'][0] . " or file: " . $_FILES[$fileNames]['name'][1]);
        }
        $this->files[0]['rows'] = count($line_x) - $i + 1;
        $this->files[1]['rows'] = count($line_y) - $i + 1;
        if($i == $length)
            throw new Exception("No data is read from the input files.<br/>Please fix the input file according to UNAVCO format for tilt data");
        $this->startTime = $this->getDate($line_x[$i]);
        $nextTimeValue = 0;
        $this->xComponent[$this->numberOfRecords] = $this->getValue($line_x[$i]);
        $this->yComponent[$this->numberOfRecords++] = $this->getValue($line_y[$i]);
        $nextTimeValue = $this->getDate($line_x[$i]);
        $step = $this->getJumpStep($nextTimeValue,$this->getDate($line_x[$i + 1]));
        $nextTimeValue->modify("+$this->sampleRate minutes");
        $i = $i + $step;
        for(;$i < $length;$i = $i + $step){
            $currentTime = $this->getDate($line_x[$i]);
            if($currentTime->getTimestamp() < $nextTimeValue->getTimestamp())
                continue;
            $this->xComponent[$this->numberOfRecords] = $this->getValue($line_x[$i]);
            $this->yComponent[$this->numberOfRecords++] = $this->getValue($line_y[$i]);
            $nextTimeValue->modify("+$this->sampleRate minutes");
        }
    }
    // this function get value in each line of input
    private function getJumpStep($record,$nextRecord){
        $diff = date_diff($record,$nextRecord);
        $minutes = intval($diff->format("%i"));
        $seconds = intval($diff->format("%s"));
        $hours = intval($diff->format("%H"));
        $v = $hours * 3600 + $minutes * 60 + $seconds;
        $v = $this->sampleRate * 60 / $v;
        return intval($v);
    }
    private function getValue($line){
       $length = strlen($line);
        if($length < 24)
            throw new Exception("This line is not a valid line: " . $line . "<br/>");
        $value = substr($line,23,10);
        $value = (double)$value;
        return $value;
    }
    // this function will get the current date written in a line
    // format: 2009-01-23T21:20:57.10 1.610
    private function getDate($line){
        $length = strlen($line);
        if($length < 10)
            throw new Exception("This line is not a valid line: " . $line . "<br/>");
        $day = substr($line,8,2);
        $month = substr($line,5,2);
        $year = substr($line,0,4);
        $hour = substr($line,11,2);
        $minute = substr($line,14,2);
        $second = substr($line,17,2);
        return date_create("$month/$day/$year $hour:$minute:$second");
    }
    public function __construct(){
        parent::__construct();
        $this->sampleRate = self::DEFAULT_SAMPLE_RATE;
        
    }
    
    public function setYComponent($yComponent){
        $this->yComponent = $yComponent;
    }
    public function getYComponent(){
        return $this->yComponent;
    }
    public function getXComponent(){
        return $this->xComponent;
    }
    public function setXComponent($xComponent){
        $this->xComponent = $xComponent;
    }
}
?>