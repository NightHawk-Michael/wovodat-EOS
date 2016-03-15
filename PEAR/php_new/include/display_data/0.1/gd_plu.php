<?php

// JPGraph library
require_once ('php/lib/jpgraph/jpgraph.php');
require_once ('php/lib/jpgraph/jpgraph_bar.php');

// Loop on sets of data
foreach ($data_list_element['sets'] as $set_number => $display_gd_plu_set) {
	
	print "\t\t\t\t\t\t<li>\n";
	// Get keys
	print "\t\t\t\t\t\t\t<p>Plume data (";
	if (empty($display_gd_plu_set['keys'][0]['name'])) {
		print "<i>unknown station</i>";
	}
	else {
		print $display_gd_plu_set['keys'][0]['name']." = \"".$display_gd_plu_set['keys'][0]['value']."\"";
		if (empty($display_gd_plu_set['keys'][0]['value'])) {
			print "<i>unknown</i>";
		}
	}
	print ")</p>\n";
	
	// Get min and max dates
	$min_date=$display_gd_plu_set['min'];
	$max_date=$display_gd_plu_set['max'];
	
	// Values
	$gd_plu_values=$display_gd_plu_set['values'];
	
	// Loop on dates
	$datax=array();
	$data_height=array();
	$data_co2=array();
	$data_so2=array();
	$data_h2s=array();
	$data_hcl=array();
	$data_hf=array();
	$data_co=array();
	$data_height_is_empty=TRUE;
	$data_co2_is_empty=TRUE;
	$data_so2_is_empty=TRUE;
	$data_h2s_is_empty=TRUE;
	$data_hcl_is_empty=TRUE;
	$data_hf_is_empty=TRUE;
	$data_co_is_empty=TRUE;
	$expected_date=$min_date;
	while (TRUE) {
		// X value = expected date
		array_push($datax, $expected_date);
		
		// Y values
		if (isset($gd_plu_values[$expected_date])) {
			array_push($data_height, $gd_plu_values[$expected_date]['height']);
			array_push($data_co2, $gd_plu_values[$expected_date]['co2']);
			array_push($data_so2, $gd_plu_values[$expected_date]['so2']);
			array_push($data_h2s, $gd_plu_values[$expected_date]['h2s']);
			array_push($data_hcl, $gd_plu_values[$expected_date]['hcl']);
			array_push($data_hf, $gd_plu_values[$expected_date]['hf']);
			array_push($data_co, $gd_plu_values[$expected_date]['co']);
		}
		else {
			array_push($data_height, NULL);
			array_push($data_co2, NULL);
			array_push($data_so2, NULL);
			array_push($data_h2s, NULL);
			array_push($data_hcl, NULL);
			array_push($data_hf, NULL);
			array_push($data_co, NULL);
		}
		
		// Check empty type of data
		if ($data_height_is_empty && $gd_plu_values[$expected_date]['height']!=NULL) {
			$data_height_is_empty=FALSE;
		}
		if ($data_co2_is_empty && $gd_plu_values[$expected_date]['co2']!=NULL) {
			$data_co2_is_empty=FALSE;
		}
		if ($data_so2_is_empty && $gd_plu_values[$expected_date]['so2']!=NULL) {
			$data_so2_is_empty=FALSE;
		}
		if ($data_h2s_is_empty && $gd_plu_values[$expected_date]['h2s']!=NULL) {
			$data_h2s_is_empty=FALSE;
		}
		if ($data_hcl_is_empty && $gd_plu_values[$expected_date]['hcl']!=NULL) {
			$data_hcl_is_empty=FALSE;
		}
		if ($data_hf_is_empty && $gd_plu_values[$expected_date]['hf']!=NULL) {
			$data_hf_is_empty=FALSE;
		}
		if ($data_co_is_empty && $gd_plu_values[$expected_date]['co']!=NULL) {
			$data_co_is_empty=FALSE;
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
			$_SESSION['errors'][0]['message']="Error when calculating expected date: ".$expected_date." [display_data/gd.php]";
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
		
		// List of graphs
		
		// Graph for height
		if (!$data_height_is_empty) {
			
			// New graph
			$graph_height = new Graph(350,250);
			
			// Margin
			$graph_height->SetMargin(50, 20, 20, 80);
			
			// Use a "text" X-scale
			$graph_height->SetScale('textlin');
			
			// Show x grid
			$graph_height->xgrid->Show();
			 
			// Specify X-labels
			$graph_height->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_height->xaxis->SetTextLabelInterval($interval);
			$graph_height->xaxis->SetLabelAngle(90);
			
			// Create the bar plot
			$bar_plot_height = new BarPlot($data_temperature);
			$bar_plot_height->SetFillColor('cadetblue3');
			
			// The order the plots are added determines who's ontop
			$graph_height->Add($bar_plot_height);
			
			// Finally output the  image
			$output_file="/gd_plu_height_set".($set_number+1).".png";
			$graph_height->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>Height (km)</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
		
		// Graph for CO2
		if (!$data_co2_is_empty) {
			
			// New graph
			$graph_co2 = new Graph(350,250);
			
			// Margin
			$graph_co2->SetMargin(50, 20, 20, 80);
			
			// Use a "text" X-scale
			$graph_co2->SetScale('textlin');
			
			// Specify X-labels
			$graph_co2->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_co2->xaxis->SetTextLabelInterval($interval);
			$graph_co2->xaxis->SetLabelAngle(90);
			
			// Show x grid
			$graph_co2->xgrid->Show();
			 
			// Create the bar plot
			$bar_plot_co2 = new BarPlot($data_co2);
			$bar_plot_co2->SetFillColor('black');
			
			// Add plot to graph
			$graph_co2->Add($bar_plot_co2);
			
			// Display graph
			$output_file="/gd_plu_co2_set".($set_number+1).".png";
			$graph_co2->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>CO2";
			if (!empty($display_gd_plu_set['units'])) {
				print " (".$display_gd_plu_set['units'].")";
			}
			print "</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
		
		// Graph for SO2
		if (!$data_so2_is_empty) {
			
			// New graph
			$graph_so2 = new Graph(350,250);
			
			// Margin
			$graph_so2->SetMargin(50, 20, 20, 80);
			
			// Use a "text" X-scale
			$graph_so2->SetScale('textlin');
			
			// Specify X-labels
			$graph_so2->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_so2->xaxis->SetTextLabelInterval($interval);
			$graph_so2->xaxis->SetLabelAngle(90);
			
			// Show x grid
			$graph_so2->xgrid->Show();
			 
			// Create the bar plot
			$bar_plot_so2 = new BarPlot($data_so2);
			$bar_plot_so2->SetFillColor('blue');
			
			// Add plot to graph
			$graph_so2->Add($bar_plot_so2);
			
			// Display graph
			$output_file="/gd_plu_so2_set".($set_number+1).".png";
			$graph_so2->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>SO2";
			if (!empty($display_gd_plu_set['units'])) {
				print " (".$display_gd_plu_set['units'].")";
			}
			print "</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
		
		// Graph for H2S
		if (!$data_h2s_is_empty) {
			
			// New graph
			$graph_h2s = new Graph(350,250);
			
			// Margin
			$graph_h2s->SetMargin(50, 20, 20, 80);
			
			// Use a "text" X-scale
			$graph_h2s->SetScale('textlin');
			
			// Specify X-labels
			$graph_h2s->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_h2s->xaxis->SetTextLabelInterval($interval);
			$graph_h2s->xaxis->SetLabelAngle(90);
			
			// Show x grid
			$graph_h2s->xgrid->Show();
			 
			// Create the bar plot
			$bar_plot_h2s = new BarPlot($data_h2s);
			$bar_plot_h2s->SetFillColor('green');
			
			// Add plot to graph
			$graph_h2s->Add($bar_plot_h2s);
			
			// Display graph
			$output_file="/gd_plu_h2s_set".($set_number+1).".png";
			$graph_h2s->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>H2S";
			if (!empty($display_gd_plu_set['units'])) {
				print " (".$display_gd_plu_set['units'].")";
			}
			print "</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
		
		// Graph for HCl
		if (!$data_hcl_is_empty) {
			
			// New graph
			$graph_hcl = new Graph(350,250);
			
			// Margin
			$graph_hcl->SetMargin(50, 20, 20, 80);
			
			// Use a "text" X-scale
			$graph_hcl->SetScale('textlin');
			
			// Specify X-labels
			$graph_hcl->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_hcl->xaxis->SetTextLabelInterval($interval);
			$graph_hcl->xaxis->SetLabelAngle(90);
			
			// Show x grid
			$graph_hcl->xgrid->Show();
			 
			// Create the bar plot
			$bar_plot_hcl = new BarPlot($data_hcl);
			$bar_plot_hcl->SetFillColor('orange');
			
			// Add plot to graph
			$graph_hcl->Add($bar_plot_hcl);
			
			// Display graph
			$output_file="/gd_plu_hcl_set".($set_number+1).".png";
			$graph_hcl->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>HCl";
			if (!empty($display_gd_plu_set['units'])) {
				print " (".$display_gd_plu_set['units'].")";
			}
			print "</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
		
		// Graph for HF
		if (!$data_hf_is_empty) {
			
			// New graph
			$graph_hf = new Graph(350,250);
			
			// Margin
			$graph_hf->SetMargin(50, 20, 20, 80);
			
			// Use a "text" X-scale
			$graph_hf->SetScale('textlin');
			
			// Specify X-labels
			$graph_hf->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_hf->xaxis->SetTextLabelInterval($interval);
			$graph_hf->xaxis->SetLabelAngle(90);
			
			// Show x grid
			$graph_hf->xgrid->Show();
			 
			// Create the bar plot
			$bar_plot_hf = new BarPlot($data_hf);
			$bar_plot_hf->SetFillColor('red');
			
			// Add plot to graph
			$graph_hf->Add($bar_plot_hf);
			
			// Display graph
			$output_file="/gd_plu_hf_set".($set_number+1).".png";
			$graph_hf->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>HF";
			if (!empty($display_gd_plu_set['units'])) {
				print " (".$display_gd_plu_set['units'].")";
			}
			print "</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
		
		// Graph for CO
		if (!$data_co_is_empty) {
			
			// New graph
			$graph_co = new Graph(350,250);
			
			// Margin
			$graph_co->SetMargin(50, 20, 20, 80);
			
			// Use a "text" X-scale
			$graph_co->SetScale('textlin');
			
			// Specify X-labels
			$graph_co->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_co->xaxis->SetTextLabelInterval($interval);
			$graph_co->xaxis->SetLabelAngle(90);
			
			// Show x grid
			$graph_co->xgrid->Show();
			 
			// Create the bar plot
			$bar_plot_co = new BarPlot($data_co);
			$bar_plot_co->SetFillColor('brown');
			
			// Add plot to graph
			$graph_co->Add($bar_plot_co);
			
			// Display graph
			$output_file="/gd_plu_co_set".($set_number+1).".png";
			$graph_co->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>CO";
			if (!empty($display_gd_plu_set['units'])) {
				print " (".$display_gd_plu_set['units'].")";
			}
			print "</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
	}
	else {
		print "\t\t\t\t\t\t\t<p>Impossible to display graph: there is not enough data in this set</p>\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
	}
	
	print "\t\t\t\t\t\t</li>\n";
	
}
 
?>