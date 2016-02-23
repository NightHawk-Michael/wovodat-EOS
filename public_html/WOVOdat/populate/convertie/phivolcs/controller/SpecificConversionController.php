<?php
class SpecificConversionController {
    protected $clientType;
    protected $owner;
    protected $dataType;
    protected $fileLinks;
    public function setFileLinks($links) {
        $this->fileLinks = $links;
    }
    public function __construct() {

    }
    public function setClientType($type) {
        if(!is_string($type))
            $this->clientType = (string)$type;
        else
            $this->clientType = $type;
    }
    public function setOwner($owner) {
        if(!is_string($owner))
            $this->owner = (string)$owner;
        else
            $this->owner = $owner;
    }
    public function setDataType($type) {
        if(!is_string($type))
            $dataType = (string)$type;
        else
            $this->dataType = $type;
    }
    public function invoke() {
        $converter = "";
        $view = "";
        switch($this->owner) {
            case "PBO":
                switch($this->dataType) {
                    case "ElectronicTiltData":
                        include_once dirname(__FILE__) . '/../model/CustomUnavcoTiltCsvConverter.php';
                        $converter = new CustomUnavcoTiltCsvConverter();
                        break;
                    default:
                        echo "<b> No data type is specified</b><br/>Please note that the specific conversion is only available for some data type.";
                        break;

                }
                break;
            case "PHIVOLCS":
                
                switch($this->dataType) {

					case "PostElectronicTiltData": 
                        include_once dirname(__FILE__).'/../model/CustomPhivolcsTiltCsvConverter.php';
                        $converter = new CustomPhivolcsTiltCsvConverter();
                        break;
					case "RSAM":
                        include_once dirname(__FILE__).'/../model/CustomPhivolcsRsamCsvConverter.php';
                        $converter = new CustomPhivolcsRsamCsvConverter();
                        $converter->setCode($_POST['CodeOfRsam']);
                        break;
                    default:
                        echo $this->dataType;
                        break;

                }
                break;
            default:
                echo "<b> No owner is specified</b><br/>Please note that the specific conversion is only available for some owner.";
                break;
        }
        if($converter != "") {
            $converter->setOwner1($this->owner);
            $converter->setOwner2($_POST['owner2']);
            $converter->setOwner3($_POST['owner3']);
			if(isset($_POST['instrument']))                 //  Nang added 
				$converter->setInstrument($_POST['instrument']);
			$converter->setStation(substr($_POST['station'],0,strpos($_POST['station'],"_sflag_")));//stationcode            
			$converter->setSampleRate($_POST['SamplingRate']);
            $converter->convert($this->fileLinks);
            $converter->generateXmlFiles();
        }else {
            
        }
        switch($this->clientType) {
            case 'thin':
                switch($this->dataType){
					case 'ElectronicTiltData':
                    case 'PostElectronicTiltData':
                        include_once dirname(__FILE__). '/../view/ThinClientSpecificTiltConversionView.php';
                        $view = new ThinClientSpecificTiltConversionView();
                        break;
                    case 'RSAM':
                        include_once dirname(__FILE__). '/../view/ThinClientSpecificRsamConversionView.php';
                        $view = new ThinClientSpecificRsamConversionView();
                        break;
                    default:
                        break;
                }
                break;
            default:
                echo "<b>Error in selectting the view type</b>";
                break;
        }
        if($view != '') {
            $view->setConverter($converter);
            $view->drawGui();
        }
    }
}
?>