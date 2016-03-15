<?php

// JPGraph library
require_once ('php/lib/jpgraph/jpgraph.php');
require_once ('php/lib/jpgraph/jpgraph_bar.php');
require_once ('php/lib/jpgraph/jpgraph_line.php');

// Loop on sets of data
foreach ($data_list_element['sets'] as $set_number => $display_sd_sam_set) {
	
	print "\t\t\t\t\t\t<li>\n";
	// Get keys
	print "\t\t\t\t\t\t\t<p>RSAM-SSAM data (";
	// Station
	if (empty($display_sd_sam_set['keys'][0])) {
		print "<i>unknown station</i>";
	}
	else {
		print "station code=\"".$display_sd_sam_set['keys'][0]."\"";
	}
	// Start time
	if (empty($display_sd_sam_set['keys'][1])) {
		print ", <i>unknown start time</i>";
	}
	else {
		print ", start time=\"".$display_sd_sam_set['keys'][1]."\"";
	}
	// End time
	if (empty($display_sd_sam_set['keys'][2])) {
		print ", <i>unknown end time</i>";
	}
	else {
		print ", end time=\"".$display_sd_sam_set['keys'][2]."\"";
	}
	print ")</p>\n";
	
	// Get min and max dates
	$min_date=$display_sd_sam_set['min'];
	$max_date=$display_sd_sam_set['max'];
	
	// Values
	$sd_sam_values=$display_sd_sam_set['values'];
	
	// Loop on dates
	$datax=array();
	$data_rsam=array();
	$data_ssam=array();
	$data_rsam_is_empty=TRUE;
	$data_ssam_is_empty=TRUE;
	$expected_date=$min_date;
	while (TRUE) {
		// X value = expected date
		array_push($datax, $expected_date);
		
		// RSAM value
		if (isset($sd_sam_values['rsam'][$expected_date])) {
			array_push($data_rsam, $sd_sam_values['rsam'][$expected_date]);
		}
		else {
			array_push($data_rsam, "");
		}
		
		// SSAM value - To be done
		
		// Check empty type of data
		if ($data_rsam_is_empty && $sd_sam_values['rsam'][$expected_date]!=NULL) {
			$data_rsam_is_empty=FALSE;
		}
		if ($data_ssam_is_empty && $sd_sam_values['ssam'][$expected_date]!=NULL) {
			$data_ssam_is_empty=FALSE;
		}
		
		// If max date, exit loop
		if ($expected_date==$max_date) {
			break;
		}
		
		// Add one hour to expected date
		if (!datetime_add_datetime($expected_date, "0000-00-00 01:00:00", $expected_date, $local_error)) {
			$_SESSION['errors']=array();
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1881;
			$_SESSION['errors'][0]['message']="Error when calculating expected date: ".$expected_date." [display_data/sd_sam.php]";
			$_SESSION['l_errors']=1;
			
			// Redirect to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		}
		
	}
	
	// Number of values to display
	$n_values=count($datax);
	// Calculate label interval (max 10 labels)
	$interval=ceil($n_values/10);
	
	// If more than 1 value
	if ($n_values>1) {
		
		// List of graphs
		
		// Graph for RSAM
		if (!$data_rsam_is_empty) {
			
			// New graph
			$graph_rsam = new Graph(350,300);
			
			// Margin
			$graph_rsam->SetMargin(50, 20, 20, 140);
			
			// Use a "text" X-scale
			$graph_rsam->SetScale('textlin');
			
			// Show x grid
			$graph_rsam->xgrid->Show();
			 
			// Specify X-labels
			$graph_rsam->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_rsam->xaxis->SetTextLabelInterval($interval);
			$graph_rsam->xaxis->SetLabelAngle(90);
			
			// Create the bar plot
			$line_plot_rsam = new LinePlot($data_rsam);
			$line_plot_rsam->SetColor('black');
			$line_plot_rsam->SetFillColor('gray');
			
			// Add plot to graph
			$graph_rsam->Add($line_plot_rsam);
			
			// Finally output the  image
			$output_file="/sd_sam_rsam_set".($set_number+1).".png";
			$graph_rsam->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>RSAM</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
		
		// Graph for SSAM
		if (!$data_ssam_is_empty) {
			print "\t\t\t\t\t\t\t<p>SSAM (display under development)</p>\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
		}
		
	}
	else {
		print "\t\t\t\t\t\t\t<p>Impossible to display graph: there is not enough data in this set</p>\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
	}
	
	print "\t\t\t\t\t\t</li>\n";
	
}
 
?>