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
	print "\t\t\t\t\t\t\t<p>EDM data (";
	if (empty($display_edm_set['keys'][0]['name'])) {
		print "<i>unknown station</i>";
	}
	else {
		print $display_edm_set['keys'][0]['name']." = ";
		if (empty($display_edm_set['keys'][0]['value'])) {
			print "<i>unknown</i>";
		}
		else {
			print "\"".$display_edm_set['keys'][0]['value']."\"";
		}
	}
	print " and ";
	if (empty($display_edm_set['keys'][1]['name'])) {
		print "<i>unknown target station</i>";
	}
	else {
		print $display_edm_set['keys'][1]['name']." = ";
		if (empty($display_edm_set['keys'][1]['value'])) {
			print "<i>unknown</i>";
		}
		else {
			print "\"".$display_edm_set['keys'][1]['value']."\"";
		}
	}
	print ")</p>\n";
	
	// Get min and max dates
	$min_date=$display_edm_set['min'];
	$max_date=$display_edm_set['max'];
	
	// Values
	$edm_values=$display_edm_set['values'];
	
	// Loop on dates
	$datax=array();
	$data_line_length=array();
	$expected_date=$min_date;
	while (TRUE) {
		// X value = expected date
		array_push($datax, $expected_date);
		
		// Y values
		if (isset($edm_values[$expected_date])) {
			array_push($data_line_length, $edm_values[$expected_date]['line_length']);
		}
		else {
			array_push($data_line_length, "-");
		}
		
		// If max date, exit loop
		if ($expected_date==$max_date) {
			break;
		}
			
		// Add one day to expected date
		if (!datetime_add_datetime($expected_date, "0000-00-01 00:00:00", $expected_date, $local_error)) {
			$_SESSION['errors']=array();
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1881;
			$_SESSION['errors'][0]['message']="Error when calculating expected date: ".$expected_date." [display_data/1.1.0/dd_edm.php]";
			$_SESSION['l_errors']=1;
			
			// Redirect to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		}
		$expected_date=substr($expected_date, 0, 10);
	}
	
	// Number of values to display
	$n_values=count($datax);
	// Calculate label interval (max 10 labels)
	$interval=ceil($n_values/10);
	
	// If more than 1 value
	if ($n_values>1) {
		
		//// Graph for line length
		
		// New graph
		$graph_line_length = new Graph(350,250);
		
		// Margin
		$graph_line_length->SetMargin(50, 20, 20, 80);
		
		// Use a "text" X-scale
		$graph_line_length->SetScale('textlin');
		
		// Show x grid
		$graph_line_length->xgrid->Show();
		 
		// Specify X-labels
		$graph_line_length->xaxis->SetTickLabels($datax);
		// Label interval
		$graph_line_length->xaxis->SetTextLabelInterval($interval);
		$graph_line_length->xaxis->SetLabelAngle(90);
		
		// Create the line plot
		$line_plot_line_length = new LinePlot($data_line_length);
		$line_plot_line_length->SetColor('black');
		
		// Set marks to the plot
		$line_plot_line_length->mark->SetType(MARK_DIAMOND);
		$line_plot_line_length->mark->SetColor('black');
		$line_plot_line_length->mark->SetFillColor('black');
		$line_plot_line_length->mark->SetSize(5);
		 
		// The order the plots are added determines who's ontop
		$graph_line_length->Add($line_plot_line_length);
		
		// Finally output the  image
		$output_file="/edm_set".($set_number+1).".png";
		$graph_line_length->Stroke($display_folder.$output_file);
		print "\t\t\t\t\t\t\t<p>Line length (m)</p>\n";
		print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
		array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
	}
	else {
		print "\t\t\t\t\t\t\t<p>Impossible to display graph: there is only 1 datum in this set</p>\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
	}
	
	print "\t\t\t\t\t\t</li>\n";
	
}
 
?>