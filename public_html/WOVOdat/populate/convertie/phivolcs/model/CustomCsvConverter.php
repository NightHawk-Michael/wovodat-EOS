<?php
abstract class CustomCsvConverter {
    protected $owner1;
    protected $owner2;
    protected $owner3;
    protected $network;
    protected $station;
    protected $stationCode;
    protected $instrument;
    protected $dowloadLink;
    protected $outputSize;
    protected $fileName;
    protected $files;
    // end time of convertion
    protected $endTime;
    // the link to get the xml file
    protected $xmlLink;
    // the total number record that is kept
    protected $numberOfRecords;
    // start time of convertion
    protected $startTime;
    const DEFAULT_SAMPLE_RATE = 10;// 10 minutes
//  const TRANSLATION_FOLDER = "C:/xampp/htdocs/home/wovodat/incoming/";
	
	const TRANSLATION_FOLDER = "../../../../../incoming/";
	 
	//each record take about 325 bytes. To achieve 300kb output file, we can store
    //about 900 records for each file.
    const MAX_XML_OUTPUT_SIZE = 900;
    // this value is also the interval in minutes
    protected $sampleRate;
    public function getOutputSize() {
        return $this->outputSize;
    }
    public function getZipFile() {
        if($this->xmlLink == "")
            throw new Exception("No file has been converted");
        return $this->xmlLink;
    }
    abstract public function generateXmlFiles();
    abstract public function convert($fileNames);
    public function setDownloadLink($link) {
        if(!is_string($link)) {
            $this->downloadLink = "";
        }else {
            $this->downloadLink = $link;
        }
    }
    public function getDownloadLink() {
        return $this->downloadLink;
    }
    public function getInstrument() {
        return $this->instrument;
    }
    public function setInstrument($instrument) {
        $this->instrument = $instrument;
    }
    public function getStationCode() {
        return $this->stationCode;
    }
    public function setStationCode($code) {
        if(!is_string($code)) {
            $this->stationCode = "";
        }else {
            $this->stationCode = $code;
        }
    }
    public function getStation() {
        return $this->station;
    }
    public function setStation($station) {
        if(!is_string($station)) {
            $this->station = "";
        }else {
            $this->station = $station;
        }
    }
    public function  __construct() {
        $this->owner1 = "";
        $this->owner2 = "";
        $this->owner3 = "";
        $this->network = "";
        $this->station = "";
        $this->stationCode = "";
        $this->instrument = "";
        $this->xComponent = "";
        $this->yComponent = "";
        $this->dowloadLink = "";
        $this->outputSize = self::MAX_XML_OUTPUT_SIZE;
    }
    // set the number of records to write to each smaller xml file.
    public function setOutputSize($size) {
        $size = intval($size);
        if($size >0) {
            $this->size = $size;
        }else {
            throw new Exception("This size is not corrent: $size.<br/>Please key in an integer value");
        }
    }
    public function setSampleRate($rate = 10) {
        $rate = intval($rate);
        if($rate > 0)
            $this->sampleRate = $rate;
        else
            throw new Exception("Sample rate is not an integer value: " . $rate . "<br/>");
    }
    public function  __destruct() {

    }
    public function getOwner1() {
        return $this->owner1;
    }
    public function setOwner1($owner) {
        if(!is_string($owner)) {
            $this->owner1 = "";
        }else {
            $this->owner1 = $owner;
        }
    }
    public function getNetwork() {
        return $this->network;
    }
    public function setNetwork($network) {
        if(!is_string($network)) {
            $this->network = "";
        }else {
            $this->network = $network;
        }
    }
    public function setOwner2($owner) {
        if(!is_string($owner)) {
            $this->owner2 = "";
        }else {
            $this->owner2 = $owner;
        }
    }
    public function getOwner2() {
        return $this->owner2;
    }
    public function getOwner3() {
        return $this->owner3;
    }
    public function setOwner3($owner) {
        if(!is_string($owner)) {
            $this->owner3 = "";
        }else {
            $this->owner3 = $owner;
        }
    }
    protected function getFileName($name){
        $length = strlen($name);
        if($length == 0){
            throw new Exception('Empty value is passed');
        }
        $i = strripos($name,'/');
        $j = strripos($name,'.');
        if($i === false && $j === false){
            return $name;
        }elseif($i === false){
            return substr($name,0,$j);
        }elseif($j === false){
            return substr($name,$i + 1,$length-$i - 1);
        }else{
            return substr($name,$i + 1,$j-$i - 1);
        }
    }
    protected function explode($string,$delimiters) {
        $length = strlen($string);
        $results = Array();
        $start = 0;
        $newWord = false;

        for($i = 0 ; $i < $length ; $i++) {
            if(strpos($delimiters,$string[$i] . "") == false) {
                // mark the beginning of a new word
                if($newWord == false) {
                    $start = $i;
                    $newWord = true;
                }
                // else keep reading the text
            }else {
                // the character is in the string delimiter
                if($newWord == true) {
                    array_push($results,substr($string,$start,$i-$start));
                    $newWord = false;
                }
            }
        }
        if($newWord) {
            array_push($results,substr($string,$start,$i-$start));
        }
        return $results;
    }

    // get the timing difference between two date time value, not expecting the
    // data will be more than 1 month
    protected function getInterval($start,$end) {
        $c = date_diff($start,$end);
        $numberOfSeconds = $c->d * 86400 + $c->h * 3600 + $c->i * 60 + $c->s;
        return $numberOfSeconds;
    }
    // this function moves file from the upload folder to the designated folder
    // that the wovodat project is using.
    public function moveFile($fileNames) {
        $numberOfFiles = count($_FILES[$fileNames]['name']);
        if($numberOfFiles == 0)
            throw new Exception("there is no file");
        if($numberOfFiles == 1) {
            $fileName = $_FILES[$fileNames]['name'];
            $fileToRead = self::TRANSLATION_FOLDER . "to_be_translated/".$fileName;
            move_uploaded_file($_FILES['fname']['tmp_name'],$fileToRead);
        }else {
            for($i = 0 ; $i < $numberOfFiles; $i++) {
                $fileName = $_FILES[$fileNames]['name'][$i];
                $fileToRead = self::TRANSLATION_FOLDER . "to_be_translated/".$fileName;
                move_uploaded_file($_FILES['fname']['tmp_name'][$i],$fileToRead);
            }
        }

    }
    protected function getMinInterval($lines,$start) {
        $length = sizeof($lines) - 1;
        $min = -1;
        $diff = 0;
        for(;$start < $length;$start++) {
            $a = $this->getTime($lines[$start]);
            $b = $this->getTime($lines[$start+1]);
            $diff = $this->getInterval($a,$b);
            if($min == -1) $min = $diff;
            elseif($diff < $min) $min = $diff;
        }
        return $min;
    }
    // get min value
    protected function getMin($a,$b) {
        return $a > $b ? $b : $a;
    }
}

?>