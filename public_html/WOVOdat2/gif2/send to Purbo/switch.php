<?php

if (isset($_GET['get'])) {
    $get = $_GET['get'];
    switch ($get) {
        case 'VolcanoList':
            include_once 'Wovodat.php';
            $wovodat = new Wovodat();
            $wovodat->getVolcanoList();
            break;
        case 'EruptionList':
            include_once 'Wovodat.php';
            $wovodat = new Wovodat();
            $wovodat->getEruptionList($_GET['cavw']);
            break;
        case 'LatLon':
            include_once 'Wovodat.php';
            $wovodat = new Wovodat();
            $wovodat->getLatLon($_GET['cavw']);
            break;
        case 'StationsWithDataList':
            include_once 'Wovodat.php';
            $wovodat = new Wovodat();
            $wovodat->getStationsWithDataList($_GET['cavw']);
            break;
        case "AllStationsList":
            include_once "Wovodat.php";
            $wovodat = new Wovodat();
            $wovodat->getAllStationsList($_GET['cavw']);
            break;
        case 'AvailableStations':
            include_once 'Wovodat.php';
            $wovodat = new Wovodat();
            $wovodat->getAvailableStations($_GET['cavw']);
            break;
        case 'Stations':
            include_once 'Wovodat.php';
            $wovodat = new Wovodat();
            $wovodat->getStations($_GET['cavw'], $_GET['type']);
            break;
        case 'StationData':
            include_once 'Wovodat.php';
            $wovodat = new Wovodat();
            $wovodat->getStationData($_GET['type'], $_GET['table'], $_GET['code'], $_GET['component'], $_GET['ref']);
            break;
        case 'Earthquakes':
            include_once "Wovodat.php";
            $wovodat = new Wovodat();
            $wovodat->getEarthquakes($_GET['qty'], $_GET['cavw'], $_GET['lat'], $_GET['lon'], $_GET['elev']);
            break;
        case 'getCcUrl':
            include_once "Wovodat.php";
            $wovodat = new Wovodat();
            $wovodat->getCCUrl($_GET['cavw']);
            break;
		case 'getNeighbors':
		include_once "Wovodat.php";
		$wovodat=new Wovodat();
		$wovodat->getNeighbors($_GET['cavw']);
		break;
        case 'FullStationData':
            include_once 'Wovodat.php';
            $wovodat = new Wovodat();
            $wovodat->getFullStationData($_GET['type'], $_GET['table'], $_GET['code'], $_GET['component']);
            break;
        default:
            break;
    }
}
?>