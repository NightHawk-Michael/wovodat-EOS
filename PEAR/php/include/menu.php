	</head>

	<body>
		<div id="pagewrapper">
			<div class="header">
				<div class="header-logo">  
					<a href="http://www.wovo.org/"><img src="/img/WOVO_logo_side.png" /></a>
				</div>	
	
	
				<div class="header-name">
					<a href="http://www.wovodat.org/"><img src="/img/WOVOdat_DataonVolcanicUnrest.gif" alt="WOVOdat - Data on Volcanic Unrest" width="748" height="32" /></a>
				</div>

				<div class="clearfix;"></div>
				</div>

				<div class="header-menu">

				<ul class="left-menu">
					<?php	
						echo"<li class='menu-item'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'><span>Home</span></a></li>";  
					?>
					<li class="menu-item"><a href="/about/news.php"><span>News</span></a></li>
					<li class="menu-item"><a><span>Visualization</span></a></li>
					<li class="menu-item"><a><span>Data Download</span></a></li>
					<li class="menu-item"><a href="/populate/home_populate.php"><span>Submit Data</span></a></li>
					<li class="menu-item"><a href="/doc/index.php"><span>Documentation</a></span></li>
					<li class="menu-item"><a href="/populate/contact_us_form.php"><span>Contact</span></a></li>
					
	
					<?php  		
						if (!isset($_SESSION)) 
							session_start();
							
						if (isset($_SESSION['login'])) {
							echo"<li class='login menu-item logshow'><a href='http://{$_SERVER['SERVER_NAME']}/populate/index.php'><span class='heavy'>LOGIN</span></a></li>";
							echo"<li class='logout menu-item loghide'><a href='http://{$_SERVER['SERVER_NAME']}/populate/my_account.php'><span class='heavy'>Account</span></a></li>";
						}else {
							echo"<li class='logout menu-item loghide'><a href='http://{$_SERVER['SERVER_NAME']}/populate/index.php'><span class='heavy'>LOGIN</span></a></li>";
							echo"<li class='login menu-item logshow'><a href='http://{$_SERVER['SERVER_NAME']}/populate/my_account.php'><span class='heavy'>Account</span></a></li>";
							
						}
					?>
				</ul>
	
				<ul class="right-menu"><li class="menu-item"><span>WOVOdat Tools Index</span> </li></ul>

				<ul class="sub-menu sub-menu-1">
					<li class="menu-item"><a href="/about/about.php"><span>More About WOVOdat</span></a></li>
					<li class="menu-item"><a href="/about/timeline.php"><span>History</span></a></li>
					<li class="menu-item"><a href="/about/useofwovodat.php"><span>Uses of WOVOdat</span></a></li>
					<li class="menu-item"><a href="/about/volcanicunrest.php"><span>What is Volcanic Unrest?</span></a></li>
				</ul>
				
				<ul class="sub-menu sub-menu-2">
					<li class="menu-item"><a href="/precursor/index_unrest_devel_v6.php"><span>Single Volcano View</span></a></li>
					<li class="menu-item"><a href="/precursor/index_unrest_devel_v5.php"><span>Side by Side Comparisons</span></a></li>
					<li class="menu-item"><a href="/eruption/index.php"><span>Temporal Evolution of Unrest</span></a></li>
					<li class="menu-item"><a href="/epiunrest/classicepisodes.php"><span>Classic Episodes of Unrest</span></a></li>
				</ul>
				<ul class="sub-menu sub-menu-3">
					<li class="menu-item"><a href="/populate/convertie/Volcano_zone/main.php?data_type=zone_index"><span>Data Search by Volcano</span></a></li>
					<li class="menu-item"><a href="/boolean/booleanIndex.php"><span>Boolean Searches</span></a></li>
				</ul>
				<ul class="sub-menu sub-menu-4">
					<li class="menu-item"><a href="/populate/regist_form.php"><span>Register</span></a></li>
				</ul>
				<ul class="sub-menu sub-menu-5">
					<li class="menu-item"><a href="/precursor/index_unrest_devel_v6.php"><span>Single volcano view</span></a></li>
					<li class="menu-item"><a href="/precursor/index_unrest_devel_v5.php"><span>Side by side comparisons</span></a></li>
					<li class="menu-item"><a href="/eruption/index.php"><span>Temporal evolution of unrest</span></a></li>
					<li class="menu-item"><a href="/epiunrest/classicepisodes.php"><span>Classic episodes of unrest</span></a></li>
					<li class="menu-item"><a href="/populate/convertie/Volcano_zone/main.php?data_type=zone_index.php"><span>Data search by volcano</span></a></li>
					<li class="menu-item"><a href="/boolean/booleanIndex.php"><span>Boolean searches</span></a></li>
					<li class="menu-item"><a href="#"><span>Additional Tools</span></a></li>
				</ul>
				<ul class="sub-menu sub-menu-6">
					<li class="menu-item"><a href="/populate/my_account.php"><span>My Account</span></a></li>
					<li class="menu-item"><a href="/populate/logout.php"><span>Logout</span></a></li>
				</ul>
