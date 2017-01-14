<?php
include_once dirname(__FILE__).'/CustomCsvConverter.php';
abstract class CustomPhivolcsCsvConverter extends CustomCsvConverter{
    public function __construct(){
        parent::__construct();

    }
}
?>