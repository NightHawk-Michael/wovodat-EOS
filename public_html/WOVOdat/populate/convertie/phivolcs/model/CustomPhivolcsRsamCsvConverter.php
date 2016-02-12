<?php
include_once dirname(__FILE__).'/CustomPhivolcsCsvConverter.php';
class CustomPhivolcsRsamCsvConverter extends CustomPhivolcsCsvConverter {
    private $data;
    private $time;
    private $code;
    public function setCode($code) {
        $this->code = $code;
    }
    public function  __construct() {
        parent::__construct();
    }
    public function generateXmlFiles() {
        if($this->getOwner1() == "")
            throw new Exception("There is no owner.");
        $owner1_tag = "owner1=\"".$this->getOwner1()."\" ";
        $owner2_tag = $this->getOwner2() == ""?"":"owner2=\"".$this->getOwner2()."\" ";
        $owner3_tag = $this->getOwner3() == ""?"":"owner3=\"".$this->getOwner3()."\" ";
        $station =$this->getStation();
        $station_tag = "station=\"$station\" ";
        $wovomlPrefix = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n <wovoml xmlns=\"http://www.wovodat.org\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" version=\"1.1.0\" xsi:schemaLocation=\"http://www.wovodat.org/WOVOdatV1.xsd\">\r\n<Data>\r\n<Seismic>\r\n<RSAM-SSAMDataset>";
        $wovomlPrefix .= "\n<RSAM-SSAM code=\"$this->code\" ".$station_tag.$owner1_tag.$owner2_tag.$owner3_tag.">";
        $wovomlPrefix .= "\n<cntInterval>".($this->sampleRate*60)."</cntInterval>\n";
        $wovomlPostfix = "</RSAM>\n</RSAM-SSAM>\n</RSAM-SSAMDataset>\n</Seismic>\n</Data>\n</wovoml>\n";
        $filePath = self::TRANSLATION_FOLDER . "translated/";
        $count = 0;
        $content = "";
        $numberOfRecords = $this->numberOfRecords;
        $start = 0;
        $end = 0;
        $i = 0;
        $interval = $this->sampleRate * 60;
        while(true) {
            $fileName = $this->fileName."_".$count.".xml";
            $file = $filePath . $fileName;
            $temp_xml = fopen($file, "w");
            if($temp_xml == false) {
                throw new Exception("Cannot create the xml file");
            }
            $start = $count * $this->outputSize;
            $end = $start + $this->outputSize;
            if($end >= $this->numberOfRecords) $end = $this->numberOfRecords;
            $startTime = $this->time[$start];
            $endTime = date_create(date_format($this->time[$end - 1],"Y-m-d H:i:s"));
            $endTime->modify("+$interval seconds");
            fwrite($temp_xml, $wovomlPrefix);
            fwrite($temp_xml,"<startTime>" . date_format($startTime,"Y-m-d H:i:s"). "</startTime>\n");
            fwrite($temp_xml,"<endTime>" . date_format($endTime,"Y-m-d H:i:s"). "</endTime>\n");
            fwrite($temp_xml, "<RSAM>\r\n");
            if($temp_xml == false) {
                throw new Exception("Cannot create the xml file");
            }
            for(;$i<$end && $this->data[$i] != "NA" ;$i++) {
                $content = $content . "<RSAMData>\n";
                $content = $content . "<cnt>" . round($this->data[$i]) . "</cnt>\n";
                $content = $content . "<startTime>" . date_format($this->time[$i],"Y-m-d H:i:s") . "</startTime>\n";
                $content = $content . "</RSAMData>\n";
                fwrite($temp_xml,$content);
                $content = "";
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
        for($i = 0 ; $i < $count ;$i++) {
            $fileName =  $this->fileName."_".$i.".xml";
            $file = $filePath . $fileName;
            $zip->addFile($file,$fileName);
        }
        $zip->close();
        for($i = 0 ; $i < $count ; $i++){
            $fileName =  $this->fileName."_".$i.".xml";
            $file = $filePath . $fileName;
            unlink($file);
        }
    }
    public function generateJsonData() {
        $output = Array();
        $output['downloadLink'] = $this->xmlLink;
        $output['outputSize'] = $this->outputSize;
        $output['numberOfRecords'] = $this->numberOfRecords;
        $output['file'] = $this->files;
        $output['data'] = $this->data;
        $output['time'] = $this->time;
        echo json_encode($output);
    }
    public function convert($fileName) {
        $this->data = Array();
        $this->time = Array();
        $this->numberOfRecords = 0;
        $this->files = Array();
        $this->files['fileName'] = $_FILES[$fileName]['name'];
        $this->files['size'] = $_FILES[$fileName]['size']/1024;
        // time limit for rsam convertion is 10 seconds
        set_time_limit(10);
        $this->moveFile($fileName);
        $rsamFile= self::TRANSLATION_FOLDER . "to_be_translated/".$_FILES[$fileName]['name'];
        $this->fileName = $this->getFileName($_FILES[$fileName]['name']);
        $lines = file($rsamFile);
        $this->files['rows'] = count($lines);
        if($lines == false)
            throw new Exception("Cannot open tilt rad file");
        $length = sizeof($lines);
        while(true){
            if(strlen(trim($lines[$length-1])) == 0)
                $length--;
            break;
        }
        if($length < 7) {
            throw new Exception("The first 7 lines must be comment lines");
        }
        for($i = 7; $i < $length ; $i++) {
            $this->data[$this->numberOfRecords] = $this->getValue($lines[$i]);
            $this->time[$this->numberOfRecords++] = $this->getTime($lines[$i]);
            
        }
        // sample rate is recorded in minutes
        $this->setSampleRate($this->getInterval($this->time[0],$this->time[1])/60);
    }

    private function getValue($line) {
        $values = explode(",",$line);
        $values[2] = preg_replace('/\0/',"",$values[2]);
        return $values[2];
    }
    protected function getTime($line) {
        $values = explode(",",$line);
        $values[1] = preg_replace('/\0/',"",$values[1]);
        return date_create($values[1]);
    }
}
?>