<?php

// JPGraph library
require_once ('php/lib/jpgraph/jpgraph.php');
require_once ('php/lib/jpgraph/jpgraph_line.php');

// Datetime functions
require_once "php/funcs/datetime_funcs.php";

// Loop on sets of data
foreach ($data_list_element['sets'] as $set_number => $display_gd_set) {
	
	print "\t\t\t\t\t\t<li>\n";
	// Get keys
	print "\t\t\t\t\t\t\t<p>Directly sampled gas data (";
	if (empty($display_gd_set['keys'][0]['name'])) {
		print "<i>unknown station</i>";
	}
	else {
		print $display_gd_set['keys'][0]['name']." = \"".$display_gd_set['keys'][0]['value']."\"";
		if (empty($display_gd_set['keys'][0]['value'])) {
			print "<i>unknown</i>";
		}
	}
	print ")</p>\n";
	
	// Get min and max dates
	$min_date=$display_gd_set['min'];
	$max_date=$display_gd_set['max'];
	
	// Values
	$gd_values=$display_gd_set['values'];
	
	// Loop on dates
	$datax=array();
	$data_temperature=array();
	$data_atmos_press=array();
	$data_emission_rate=array();
	$data_co2=array();
	$data_so2=array();
	$data_h2s=array();
	$data_hcl=array();
	$data_hf=array();
	$data_ch4=array();
	$data_h2=array();
	$data_co=array();
	$data_co2wf=array();
	$data_so2wf=array();
	$data_h2swf=array();
	$data_hclwf=array();
	$data_hfwf=array();
	$data_ch4wf=array();
	$data_h2wf=array();
	$data_cowf=array();
	$data_ele3he4he=array();
	$data_delta13c=array();
	$data_delta34s=array();
	$data_delta18o=array();
	$data_deltad=array();
	$data_temperature_is_empty=TRUE;
	$data_atmos_press_is_empty=TRUE;
	$data_emission_rate_is_empty=TRUE;
	$data_co2_is_empty=TRUE;
	$data_so2_is_empty=TRUE;
	$data_h2s_is_empty=TRUE;
	$data_hcl_is_empty=TRUE;
	$data_hf_is_empty=TRUE;
	$data_ch4_is_empty=TRUE;
	$data_h2_is_empty=TRUE;
	$data_co_is_empty=TRUE;
	$data_co2wf_is_empty=TRUE;
	$data_so2wf_is_empty=TRUE;
	$data_h2swf_is_empty=TRUE;
	$data_hclwf_is_empty=TRUE;
	$data_hfwf_is_empty=TRUE;
	$data_ch4wf_is_empty=TRUE;
	$data_h2wf_is_empty=TRUE;
	$data_cowf_is_empty=TRUE;
	$data_ele3he4he_is_empty=TRUE;
	$data_delta13c_is_empty=TRUE;
	$data_delta34s_is_empty=TRUE;
	$data_delta18o_is_empty=TRUE;
	$data_deltad_is_empty=TRUE;
	$expected_date=$min_date;
	while (TRUE) {
		// X value = expected date
		array_push($datax, $expected_date);
		
		// Y values
		if (isset($gd_values[$expected_date])) {
			array_push($data_temperature, $gd_values[$expected_date]['temperature']);
			array_push($data_atmos_press, $gd_values[$expected_date]['atmos_press']);
			array_push($data_emission_rate, $gd_values[$expected_date]['emission_rate']);
			array_push($data_co2, $gd_values[$expected_date]['co2']);
			array_push($data_so2, $gd_values[$expected_date]['so2']);
			array_push($data_h2s, $gd_values[$expected_date]['h2s']);
			array_push($data_hcl, $gd_values[$expected_date]['hcl']);
			array_push($data_hf, $gd_values[$expected_date]['hf']);
			array_push($data_ch4, $gd_values[$expected_date]['ch4']);
			array_push($data_h2, $gd_values[$expected_date]['h2']);
			array_push($data_co, $gd_values[$expected_date]['co']);
			array_push($data_co2wf, $gd_values[$expected_date]['co2wf']);
			array_push($data_so2wf, $gd_values[$expected_date]['so2wf']);
			array_push($data_h2swf, $gd_values[$expected_date]['h2swf']);
			array_push($data_hclwf, $gd_values[$expected_date]['hclwf']);
			array_push($data_hfwf, $gd_values[$expected_date]['hfwf']);
			array_push($data_ch4wf, $gd_values[$expected_date]['ch4wf']);
			array_push($data_h2wf, $gd_values[$expected_date]['h2wf']);
			array_push($data_cowf, $gd_values[$expected_date]['cowf']);
			array_push($data_ele3he4he, $gd_values[$expected_date]['ele3he4he']);
			array_push($data_delta13c, $gd_values[$expected_date]['delta13c']);
			array_push($data_delta34s, $gd_values[$expected_date]['delta34s']);
			array_push($data_delta18o, $gd_values[$expected_date]['delta18o']);
			array_push($data_deltad, $gd_values[$expected_date]['deltad']);
		}
		else {
			array_push($data_temperature, NULL);
			array_push($data_atmos_press, NULL);
			array_push($data_emission_rate, NULL);
			array_push($data_co2, NULL);
			array_push($data_so2, NULL);
			array_push($data_h2s, NULL);
			array_push($data_hcl, NULL);
			array_push($data_hf, NULL);
			array_push($data_ch4, NULL);
			array_push($data_h2, NULL);
			array_push($data_co, NULL);
			array_push($data_co2wf, NULL);
			array_push($data_so2wf, NULL);
			array_push($data_h2swf, NULL);
			array_push($data_hclwf, NULL);
			array_push($data_hfwf, NULL);
			array_push($data_ch4wf, NULL);
			array_push($data_h2wf, NULL);
			array_push($data_cowf, NULL);
			array_push($data_ele3he4he, NULL);
			array_push($data_delta13c, NULL);
			array_push($data_delta34s, NULL);
			array_push($data_delta18o, NULL);
			array_push($data_deltad, NULL);
		}
		
		// Check empty type of data
		if ($data_temperature_is_empty && $gd_values[$expected_date]['temperature']!=NULL) {
			$data_temperature_is_empty=FALSE;
		}
		if ($data_atmos_press_is_empty && $gd_values[$expected_date]['atmos_press']!=NULL) {
			$data_atmos_press_is_empty=FALSE;
		}
		if ($data_emission_rate_is_empty && $gd_values[$expected_date]['emission_rate']!=NULL) {
			$data_emission_rate_is_empty=FALSE;
		}
		if ($data_co2_is_empty && $gd_values[$expected_date]['co2']!=NULL) {
			$data_co2_is_empty=FALSE;
		}
		if ($data_so2_is_empty && $gd_values[$expected_date]['so2']!=NULL) {
			$data_so2_is_empty=FALSE;
		}
		if ($data_h2s_is_empty && $gd_values[$expected_date]['h2s']!=NULL) {
			$data_h2s_is_empty=FALSE;
		}
		if ($data_hcl_is_empty && $gd_values[$expected_date]['hcl']!=NULL) {
			$data_hcl_is_empty=FALSE;
		}
		if ($data_hf_is_empty && $gd_values[$expected_date]['hf']!=NULL) {
			$data_hf_is_empty=FALSE;
		}
		if ($data_ch4_is_empty && $gd_values[$expected_date]['ch4']!=NULL) {
			$data_ch4_is_empty=FALSE;
		}
		if ($data_h2_is_empty && $gd_values[$expected_date]['h2']!=NULL) {
			$data_h2_is_empty=FALSE;
		}
		if ($data_co_is_empty && $gd_values[$expected_date]['co']!=NULL) {
			$data_co_is_empty=FALSE;
		}
		if ($data_co2wf_is_empty && $gd_values[$expected_date]['co2wf']!=NULL) {
			$data_co2wf_is_empty=FALSE;
		}
		if ($data_so2wf_is_empty && $gd_values[$expected_date]['so2wf']!=NULL) {
			$data_so2wf_is_empty=FALSE;
		}
		if ($data_h2swf_is_empty && $gd_values[$expected_date]['h2swf']!=NULL) {
			$data_h2swf_is_empty=FALSE;
		}
		if ($data_hclwf_is_empty && $gd_values[$expected_date]['hclwf']!=NULL) {
			$data_hclwf_is_empty=FALSE;
		}
		if ($data_hfwf_is_empty && $gd_values[$expected_date]['hfwf']!=NULL) {
			$data_hfwf_is_empty=FALSE;
		}
		if ($data_ch4wf_is_empty && $gd_values[$expected_date]['ch4wf']!=NULL) {
			$data_ch4wf_is_empty=FALSE;
		}
		if ($data_h2wf_is_empty && $gd_values[$expected_date]['h2wf']!=NULL) {
			$data_h2wf_is_empty=FALSE;
		}
		if ($data_cowf_is_empty && $gd_values[$expected_date]['cowf']!=NULL) {
			$data_cowf_is_empty=FALSE;
		}
		if ($data_ele3he4he_is_empty && $gd_values[$expected_date]['ele3he4he']!=NULL) {
			$data_ele3he4he_is_empty=FALSE;
		}
		if ($data_delta13c_is_empty && $gd_values[$expected_date]['delta13c']!=NULL) {
			$data_delta13c_is_empty=FALSE;
		}
		if ($data_delta34s_is_empty && $gd_values[$expected_date]['delta34s']!=NULL) {
			$data_delta34s_is_empty=FALSE;
		}
		if ($data_delta18o_is_empty && $gd_values[$expected_date]['delta18o']!=NULL) {
			$data_delta18o_is_empty=FALSE;
		}
		if ($data_deltad_is_empty && $gd_values[$expected_date]['deltad']!=NULL) {
			$data_deltad_is_empty=FALSE;
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
		
		// Graph for temperature
		if (!$data_temperature_is_empty) {
			
			// New graph
			$graph_temperature = new Graph(350,250);
			
			// Margin
			$graph_temperature->SetMargin(50, 20, 20, 80);
			
			// Use a "text" X-scale
			$graph_temperature->SetScale('textlin');
			
			// Show x grid
			$graph_temperature->xgrid->Show();
			 
			// Specify X-labels
			$graph_temperature->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_temperature->xaxis->SetTextLabelInterval($interval);
			$graph_temperature->xaxis->SetLabelAngle(90);
			
			// Create the line plot
			$line_plot_temperature = new LinePlot($data_temperature);
			$line_plot_temperature->SetColor('black');
			
			// Set marks to the plot
			$line_plot_temperature->mark->SetType(MARK_DIAMOND);
			$line_plot_temperature->mark->SetColor('black');
			$line_plot_temperature->mark->SetFillColor('black');
			$line_plot_temperature->mark->SetSize(5);
			 
			// The order the plots are added determines who's ontop
			$graph_temperature->Add($line_plot_temperature);
			
			// Finally output the  image
			$output_file="/gd_temperature_set".($set_number+1).".png";
			$graph_temperature->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>Temperature (&deg;C)</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
		
		// Graph for atmospheric pressure
		if (!$data_atmos_press_is_empty) {
			
			// New graph
			$graph_atmos_press = new Graph(350,250);
			
			// Margin
			$graph_atmos_press->SetMargin(50, 20, 20, 80);
			
			// Use a "text" X-scale
			$graph_atmos_press->SetScale('textlin');
			
			// Show x grid
			$graph_atmos_press->xgrid->Show();
			 
			// Specify X-labels
			$graph_atmos_press->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_atmos_press->xaxis->SetTextLabelInterval($interval);
			$graph_atmos_press->xaxis->SetLabelAngle(90);
			
			// Create the line plot
			$line_plot_atmos_press = new LinePlot($data_atmos_press);
			$line_plot_atmos_press->SetColor('black');
			
			// Set marks to the plot
			$line_plot_atmos_press->mark->SetType(MARK_DIAMOND);
			$line_plot_atmos_press->mark->SetColor('black');
			$line_plot_atmos_press->mark->SetFillColor('black');
			$line_plot_atmos_press->mark->SetSize(5);
			 
			// The order the plots are added determines who's ontop
			$graph_atmos_press->Add($line_plot_atmos_press);
			
			// Output image
			$output_file="/gd_atmos_press_set".($set_number+1).".png";
			$graph_atmos_press->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>Atmospheric pressure (mbar)</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
		
		// Graph for emission rate
		if (!$data_emission_rate_is_empty) {
			
			// New graph
			$graph_emission_rate = new Graph(350,250);
			
			// Margin
			$graph_emission_rate->SetMargin(50, 20, 20, 80);
			
			// Use a "text" X-scale
			$graph_emission_rate->SetScale('textlin');
			
			// Show x grid
			$graph_emission_rate->xgrid->Show();
			 
			// Specify X-labels
			$graph_emission_rate->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_emission_rate->xaxis->SetTextLabelInterval($interval);
			$graph_emission_rate->xaxis->SetLabelAngle(90);
			
			// Create the line plot
			$line_plot_emission_rate = new LinePlot($data_emission_rate);
			$line_plot_emission_rate->SetColor('black');
			
			// Set marks to the plot
			$line_plot_emission_rate->mark->SetType(MARK_DIAMOND);
			$line_plot_emission_rate->mark->SetColor('black');
			$line_plot_emission_rate->mark->SetFillColor('black');
			$line_plot_emission_rate->mark->SetSize(5);
			 
			// The order the plots are added determines who's ontop
			$graph_emission_rate->Add($line_plot_emission_rate);
			
			// Finally output the  image
			$output_file="/gd_emission_rate_set".($set_number+1).".png";
			$graph_emission_rate->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>Emission rate</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
		
		// Graph for species
		if (!$data_co2_is_empty ||
		!$data_so2_is_empty ||
		!$data_h2s_is_empty ||
		!$data_hcl_is_empty ||
		!$data_hf_is_empty ||
		!$data_ch4_is_empty ||
		!$data_h2_is_empty ||
		!$data_co_is_empty ||
		!$data_co2wf_is_empty ||
		!$data_so2wf_is_empty ||
		!$data_h2swf_is_empty ||
		!$data_hclwf_is_empty ||
		!$data_hfwf_is_empty ||
		!$data_ch4wf_is_empty ||
		!$data_h2wf_is_empty ||
		!$data_cowf_is_empty ||
		!$data_ele3he4he_is_empty ||
		!$data_delta13c_is_empty ||
		!$data_delta34s_is_empty ||
		!$data_delta18o_is_empty ||
		!$data_deltad_is_empty) {
			
			// New graph
			$graph_species = new Graph(350,500);
			
			// Margin
			$graph_species->SetMargin(50, 20, 20, 320);
			
			// Use a "text" X-scale
			$graph_species->SetScale('textlin');
			
			// Show x grid
			$graph_species->xgrid->Show();
			 
			// Specify X-labels
			$graph_species->xaxis->SetTickLabels($datax);
			// Label interval
			$graph_species->xaxis->SetTextLabelInterval($interval);
			$graph_species->xaxis->SetLabelAngle(90);
			
			// Create the line plots
			// CO2
			if (!$data_co2_is_empty) {
				$line_plot_co2 = new LinePlot($data_co2);
				$line_plot_co2->SetColor('black');
				
				// Set marks to the plot
				$line_plot_co2->mark->SetType(MARK_DIAMOND);
				$line_plot_co2->mark->SetColor('black');
				$line_plot_co2->mark->SetFillColor('black');
				$line_plot_co2->mark->SetSize(5);
				
				// Set legend
				$line_plot_co2->SetLegend("CO2");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_co2);
			}
			// SO2
			if (!$data_so2_is_empty) {
				$line_plot_so2 = new LinePlot($data_so2);
				$line_plot_so2->SetColor('blue');
				
				// Set marks to the plot
				$line_plot_so2->mark->SetType(MARK_DIAMOND);
				$line_plot_so2->mark->SetColor('blue');
				$line_plot_so2->mark->SetFillColor('blue');
				$line_plot_so2->mark->SetSize(5);
				 
				// Set legend
				$line_plot_so2->SetLegend("SO2");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_so2);
			}
			// H2S
			if (!$data_h2s_is_empty) {
				$line_plot_h2s = new LinePlot($data_h2s);
				$line_plot_h2s->SetColor('green');
				
				// Set marks to the plot
				$line_plot_h2s->mark->SetType(MARK_DIAMOND);
				$line_plot_h2s->mark->SetColor('green');
				$line_plot_h2s->mark->SetFillColor('green');
				$line_plot_h2s->mark->SetSize(5);
				 
				// Set legend
				$line_plot_h2s->SetLegend("H2S");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_h2s);
			}
			// HCl
			if (!$data_hcl_is_empty) {
				$line_plot_hcl = new LinePlot($data_hcl);
				$line_plot_hcl->SetColor('orange');
				
				// Set marks to the plot
				$line_plot_hcl->mark->SetType(MARK_DIAMOND);
				$line_plot_hcl->mark->SetColor('orange');
				$line_plot_hcl->mark->SetFillColor('orange');
				$line_plot_hcl->mark->SetSize(5);
				
				// Set legend
				$line_plot_hcl->SetLegend("HCl");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_hcl);
			}
			// HF
			if (!$data_hf_is_empty) {
				$line_plot_hf = new LinePlot($data_hf);
				$line_plot_hf->SetColor('red');
				
				// Set marks to the plot
				$line_plot_hf->mark->SetType(MARK_DIAMOND);
				$line_plot_hf->mark->SetColor('red');
				$line_plot_hf->mark->SetFillColor('red');
				$line_plot_hf->mark->SetSize(5);
				
				// Set legend
				$line_plot_hf->SetLegend("HF");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_hf);
			}
			// CH4
			if (!$data_ch4_is_empty) {
				$line_plot_ch4 = new LinePlot($data_ch4);
				$line_plot_ch4->SetColor('purple');
				
				// Set marks to the plot
				$line_plot_ch4->mark->SetType(MARK_DIAMOND);
				$line_plot_ch4->mark->SetColor('purple');
				$line_plot_ch4->mark->SetFillColor('purple');
				$line_plot_ch4->mark->SetSize(5);
				
				// Set legend
				$line_plot_ch4->SetLegend("CH4");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_ch4);
			}
			// H2
			if (!$data_h2_is_empty) {
				$line_plot_h2 = new LinePlot($data_h2);
				$line_plot_h2->SetColor('magenta');
				
				// Set marks to the plot
				$line_plot_h2->mark->SetType(MARK_DIAMOND);
				$line_plot_h2->mark->SetColor('magenta');
				$line_plot_h2->mark->SetFillColor('magenta');
				$line_plot_h2->mark->SetSize(5);
				
				// Set legend
				$line_plot_h2->SetLegend("H2");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_h2);
			}
			// CO
			if (!$data_co_is_empty) {
				$line_plot_co = new LinePlot($data_co);
				$line_plot_co->SetColor('brown');
				
				// Set marks to the plot
				$line_plot_co->mark->SetType(MARK_DIAMOND);
				$line_plot_co->mark->SetColor('brown');
				$line_plot_co->mark->SetFillColor('brown');
				$line_plot_co->mark->SetSize(5);
				
				// Set legend
				$line_plot_co->SetLegend("CO");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_co);
			}
			// CO2 water-free
			if (!$data_co2wf_is_empty) {
				$line_plot_co2wf = new LinePlot($data_co2wf);
				$line_plot_co2wf->SetColor('black');
				
				// Set marks to the plot
				$line_plot_co2wf->mark->SetType(MARK_X);
				$line_plot_co2wf->mark->SetColor('black');
				$line_plot_co2wf->mark->SetFillColor('black');
				$line_plot_co2wf->mark->SetSize(5);
				
				// Set legend
				$line_plot_co2wf->SetLegend("CO2 water-free");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_co2wf);
			}
			// SO2 water-free
			if (!$data_so2wf_is_empty) {
				$line_plot_so2wf = new LinePlot($data_so2wf);
				$line_plot_so2wf->SetColor('blue');
				
				// Set marks to the plot
				$line_plot_so2wf->mark->SetType(MARK_X);
				$line_plot_so2wf->mark->SetColor('blue');
				$line_plot_so2wf->mark->SetFillColor('blue');
				$line_plot_so2wf->mark->SetSize(5);
				 
				// Set legend
				$line_plot_so2wf->SetLegend("SO2 water-free");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_so2wf);
			}
			// H2S water-free
			if (!$data_h2swf_is_empty) {
				$line_plot_h2swf = new LinePlot($data_h2swf);
				$line_plot_h2swf->SetColor('green');
				
				// Set marks to the plot
				$line_plot_h2swf->mark->SetType(MARK_X);
				$line_plot_h2swf->mark->SetColor('green');
				$line_plot_h2swf->mark->SetFillColor('green');
				$line_plot_h2swf->mark->SetSize(5);
				 
				// Set legend
				$line_plot_h2swf->SetLegend("H2S water-free");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_h2swf);
			}
			// HCl water-free
			if (!$data_hclwf_is_empty) {
				$line_plot_hclwf = new LinePlot($data_hclwf);
				$line_plot_hclwf->SetColor('orange');
				
				// Set marks to the plot
				$line_plot_hclwf->mark->SetType(MARK_X);
				$line_plot_hclwf->mark->SetColor('orange');
				$line_plot_hclwf->mark->SetFillColor('orange');
				$line_plot_hclwf->mark->SetSize(5);
				
				// Set legend
				$line_plot_hclwf->SetLegend("HCl water-free");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_hclwf);
			}
			// HF water-free
			if (!$data_hfwf_is_empty) {
				$line_plot_hfwf = new LinePlot($data_hfwf);
				$line_plot_hfwf->SetColor('red');
				
				// Set marks to the plot
				$line_plot_hfwf->mark->SetType(MARK_X);
				$line_plot_hfwf->mark->SetColor('red');
				$line_plot_hfwf->mark->SetFillColor('red');
				$line_plot_hfwf->mark->SetSize(5);
				
				// Set legend
				$line_plot_hfwf->SetLegend("HF water-free");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_hfwf);
			}
			// CH4 water-free
			if (!$data_ch4wf_is_empty) {
				$line_plot_ch4wf = new LinePlot($data_ch4);
				$line_plot_ch4wf->SetColor('purple');
				
				// Set marks to the plot
				$line_plot_ch4wf->mark->SetType(MARK_X);
				$line_plot_ch4wf->mark->SetColor('purple');
				$line_plot_ch4wf->mark->SetFillColor('purple');
				$line_plot_ch4wf->mark->SetSize(5);
				
				// Set legend
				$line_plot_ch4wf->SetLegend("CH4 water-free");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_ch4wf);
			}
			// H2 water-free
			if (!$data_h2wf_is_empty) {
				$line_plot_h2wf = new LinePlot($data_h2wf);
				$line_plot_h2wf->SetColor('magenta');
				
				// Set marks to the plot
				$line_plot_h2wf->mark->SetType(MARK_X);
				$line_plot_h2wf->mark->SetColor('magenta');
				$line_plot_h2wf->mark->SetFillColor('magenta');
				$line_plot_h2wf->mark->SetSize(5);
				
				// Set legend
				$line_plot_h2wf->SetLegend("H2 water-free");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_h2wf);
			}
			// CO water-free
			if (!$data_cowf_is_empty) {
				$line_plot_cowf = new LinePlot($data_cowf);
				$line_plot_cowf->SetColor('brown');
				
				// Set marks to the plot
				$line_plot_cowf->mark->SetType(MARK_X);
				$line_plot_cowf->mark->SetColor('brown');
				$line_plot_cowf->mark->SetFillColor('brown');
				$line_plot_cowf->mark->SetSize(5);
				
				// Set legend
				$line_plot_cowf->SetLegend("CO water-free");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_cowf);
			}
			// 3He/4He
			if (!$data_ele3he4he_is_empty) {
				$line_plot_ele3he4he = new LinePlot($data_ele3he4he);
				$line_plot_ele3he4he->SetColor('turquoise');
				
				// Set marks to the plot
				$line_plot_ele3he4he->mark->SetType(MARK_DIAMOND);
				$line_plot_ele3he4he->mark->SetColor('turquoise');
				$line_plot_ele3he4he->mark->SetFillColor('turquoise');
				$line_plot_ele3he4he->mark->SetSize(5);
				
				// Set legend
				$line_plot_ele3he4he->SetLegend("3He/4He");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_ele3he4he);
			}
			// Delta 13C
			if (!$data_delta13c_is_empty) {
				$line_plot_delta13c = new LinePlot($data_delta13c);
				$line_plot_delta13c->SetColor('darkmagenta');
				
				// Set marks to the plot
				$line_plot_delta13c->mark->SetType(MARK_DIAMOND);
				$line_plot_delta13c->mark->SetColor('darkmagenta');
				$line_plot_delta13c->mark->SetFillColor('darkmagenta');
				$line_plot_delta13c->mark->SetSize(5);
				 
				// Set legend
				$line_plot_delta13c->SetLegend("Delta 13C");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_delta13c);
			}
			// Delta 34S
			if (!$data_delta34s_is_empty) {
				$line_plot_delta34s = new LinePlot($data_delta34s);
				$line_plot_delta34s->SetColor('forestgreen');
				
				// Set marks to the plot
				$line_plot_delta34s->mark->SetType(MARK_DIAMOND);
				$line_plot_delta34s->mark->SetColor('forestgreen');
				$line_plot_delta34s->mark->SetFillColor('forestgreen');
				$line_plot_delta34s->mark->SetSize(5);
				 
				// Set legend
				$line_plot_delta34s->SetLegend("Delta 34S");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_delta34s);
			}
			// Delta 18O
			if (!$data_delta18o_is_empty) {
				$line_plot_delta18o = new LinePlot($data_delta18o);
				$line_plot_delta18o->SetColor('darkblue');
				
				// Set marks to the plot
				$line_plot_delta18o->mark->SetType(MARK_DIAMOND);
				$line_plot_delta18o->mark->SetColor('darkblue');
				$line_plot_delta18o->mark->SetFillColor('darkblue');
				$line_plot_delta18o->mark->SetSize(5);
				
				// Set legend
				$line_plot_delta18o->SetLegend("Delta 18O");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_delta18o);
			}
			// Delta D
			if (!$data_deltad_is_empty) {
				$line_plot_deltad = new LinePlot($data_deltad);
				$line_plot_deltad->SetColor('gray');
				
				// Set marks to the plot
				$line_plot_deltad->mark->SetType(MARK_DIAMOND);
				$line_plot_deltad->mark->SetColor('gray');
				$line_plot_deltad->mark->SetFillColor('gray');
				$line_plot_deltad->mark->SetSize(5);
				
				// Set legend
				$line_plot_deltad->SetLegend("Delta D");
				
				// The order the plots are added determines who's ontop
				$graph_species->Add($line_plot_deltad);
			}
			
			// Set legend
			$graph_species->legend->Pos(0.5, 0.55, "center", "top");
			$graph_species->legend->SetColumns(2);
			
			// Finally output the image
			$output_file="/gd_species_set".($set_number+1).".png";
			$graph_species->Stroke($display_folder.$output_file);
			print "\t\t\t\t\t\t\t<p>Measured species";
			if (!empty($display_gd_set['units'])) {
				print " (".$display_gd_set['units'].")";
			}
			print "</p>\n";
			print "\t\t\t\t\t\t\t<img src=\"".$src_folder.$output_file."\" />\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
			array_push($_SESSION['upload']['display']['files'], $display_folder.$output_file);
		}
	}
	else {
		print "\t\t\t\t\t\t\t<p>Impossible to display graph: there is only 1 datum in this set</p>\n\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t<br />\n";
	}
	
	print "\t\t\t\t\t\t</li>\n";
	
}
 
?>