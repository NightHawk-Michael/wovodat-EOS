<?php

// JPGraph library
require_once ('php/lib/jpgraph/jpgraph.php');
require_once ('php/lib/jpgraph/jpgraph_line.php');

// Datetime functions
require_once "php/funcs/datetime_funcs.php";

// Loop on sets of data
foreach ($data_list_element['sets'] as $set_number => $display_edm_set) {
	
	print "\t\t\t\t\t\t<li>\n";
	// Get keys
	print "\t\t\t\t\t\t\t<p>EDM data (".$display_edm_set['keys'][0]['name']." = \"".$display_edm_set['keys'][0]['value']."\"";
	if (empty($display_edm_set['keys'][0]['value'])) {
		print "<i>unknown</i>";
	}
	print " and ".$display_edm_set['keys'][1]['name']." = \"".$display_edm_set['keys'][1]['value']."\"";
	if (empty($display_edm_set['keys'][1]['value'])) {
		print "<i>unknown</i>";
	}
	print ")</p>\n";
	
	// Get data
	$x_original=array();
	$y_original=array();
	foreach ($display_edm_set['values'] as $values) {
		// Make time as -> YYYY/MM/DD (because display day by day)
		if (!datetime_round_day($values['x'], $x_value, $local_error)) {
			$_SESSION['errors']=array();
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1880;
			$_SESSION['errors'][0]['message']="Error when rounding data to day: ".$values['x']."[display_data/dd_edm.php]";
			$_SESSION['l_errors']=1;
			
			// Redirect to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		}
		
		// If no such X value was given
		$found=FALSE;
		foreach ($x_original as $existing_x_value) {
			if ($existing_x_value==$x_value) {
				$found=TRUE;
				break;
			}
		}
		if (!$found) {
			array_push($x_original, $x_value);
			array_push($y_original, $values['y']);
		}
	}
	
	// Sort data
	array_multisort($x_original, $y_original);
	
	// Get min and max dates
	$min_date=$x_original[0];
	$max_date=$x_original[count($x_original)-1];
	
	// Loop on dates
	$datax=array();
	$datay=array();
	$data_date=$min_date;
	$expected_date=$min_date;
	$cnt=0;
	while (TRUE) {
		// X value = expected date
		array_push($datax, $expected_date);
		
		// Y value -- Compare data date with expected date: if same, get value - else, "-"
		if ($expected_date==$data_date) {
			array_push($datay, $y_original[$cnt]);
			
			// If max date, exit loop
			if ($expected_date==$max_date) {
				break;
			}
			
			// Next data date to find
			$cnt++;
			$data_date=$x_original[$cnt];
		
		}
		else {
			array_push($datay, "-");
		}
		
		// Add one day to expected date
		if (!datetime_add_datetime($expected_date, "0000-00-01 00:00:00", $expected_date, $local_error)) {
			$_SESSION['errors']=array();
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1881;
			$_SESSION['errors'][0]['message']="Error when calculating expected date: ".$expected_date." [display_data/dd_edm.php]";
			$_SESSION['l_errors']=1;
			
			// Redirect to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		}
		$expected_date=substr($expected_date, 0, 10);
	}
	
	// New graph
	$graph = new Graph(350,250);
	
	// Margin
	$graph->SetMargin(50, 20, 20, 80);
	
	// Use a "text" X-scale
	$graph->SetScale('textlin');
	
	// Show x grid
	$graph->xgrid->Show();
	 
	// Specify X-labels
	$graph->xaxis->SetTickLabels($datax);
	// Calculate label interval (max 10 labels)
	$interval=ceil(count($datay)/10);
	$graph->xaxis->SetTextLabelInterval($interval);
	$graph->xaxis->SetLabelAngle(90);
	
	// Create the line plot
	$lp1 = new LinePlot($datay);
	$lp1->SetColor('black');
	
	// Set marks to the plot
	$lp1->mark->SetType(MARK_DIAMOND);
	$lp1->mark->SetColor('black');
	$lp1->mark->SetFillColor('black');
	$lp1->mark->SetSize(5);
	 
	// The order the plots are added determines who's ontop
	$graph->Add($lp1);
	
	// Finally output the  image
	$output_file="/edm_set".($set_number+1).".png";
	$graph->Stroke($display_folder.$output_file);
	print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
	print "\t\t\t\t\t\t</li>\n";
	array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);

}
 
?>