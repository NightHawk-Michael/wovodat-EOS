<?php
if (!isset($_SESSION))
    session_start();
?>

<link href="/css/index.css" rel="stylesheet" type="text/css">
<link href="/css/normalize.css" rel="stylesheet" type="text/css">
<!--<style type="text/css">
    #header2 div:first-child{
        width: 180px;
    }
    #header2 div a{
        color:white;
    }
    #header2 div ul li{
        color: white;
        display: inline;
        padding-bottom: 2px;
        padding-left: 10px;
        padding-right: 10px;
        text-align:center;
        font-size: 1.2em;
    }
    #header2 div ul li:hover{
        background-color: grey;
        color: black;
    }
    #wovodatMenu{
        margin-left: 50px;
    }
    #header2 div ul{
        list-style-type:none;
        border-width: 0px;
        padding: 0px 0px 0px 0px;
        margin: 0px 0px 0px 0px;
        height: 18px;
    } -->
</style>
<div class="header">
    <div class="container"> 
        <div class="header-logo">  <!-- header -->
            <table>
                <tr>
                    <td>
                        <div class="">
                            <a href="http://www.wovo.org/">
                                <img src="/gif2/WOVO_logo.gif" width="50" height="50" />
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="header-name">
                            <a href="http://www.wovodat.org/">
                                <span class="header-bigname">WOVOdat</span>
                                <span class="header-smallname"> A Database of Volcanic Unrest</span></a>
                        </div>
                    </td>
                    <td>
                        <div class="eos-div">
                            <a href="http://www.earthobservatory.sg/">
                                <img src="/gif2/EOS_logo_3.png" />
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="header-menu">
                <ul class="left-menu">
                    <li class="menu-item"><a href="/"><span>Home</span></a></li>
                    <li>|</li>
                    <li class="menu-item"><a href="/docum"><span>Documentation</span></a></li>
                    <li>|</li>
                    <li class="menu-item"><a><span class='menu-item'>Volcano</span></a></li>
                    <li>|</li>
                    <li class="menu-item"><a href="/populate/home_populate.php"><span>SubmitData</span></a></li>
                    <li>|</li>
                    <li class="menu-item"><a href="/populate/contact_us_form.php"><span>Contact</span></a></li>
                </ul>

                <ul class="right-menu" >
                    <!-- <li class="menu-item"><a href="/populate/index.php"><span>Register | Login</span></a></li> -->
                    <?php
                    if (isset($_SESSION['login'])) {
                        ?>
                        <li>
                            <a href="/populate/my_account.php"><?php 
                            $n = $_SESSION['login']['cr_uname'];
                            $l = strlen($n);
                            if($l > 12) $n = substr($n,0,12) . '...';
                            echo $n; 
                            ?></a>
                        </li>
                        <li class="menu-item">
                            <a href="/populate/logout.php"><span>Logout</span></a>
                        </li>
                        <?php
                    } else {
                        ?>

                        <li class="menu-item">
                            <a href="/populate/index.php?attempt=0"><span>Register | Login</span></a>
                        </li>
                        <?php
                    }
                    ?>
                    </ul>
                <ul class="sub-menu-1">
                    <li class="menu-item"><div class="stripe"></div><a href="/about"><span>More About WOVOdat</span></a></li>
                    <li class="menu-item"><a href="/about/useofwovodat.php"><span>Uses of WOVOdat</span></a></li>
                    <li class="menu-item"><a href="/about/timeline.php"><span>History</span></a></li>
                </ul>
                <ul class="sub-menu-2">
                    <li class="menu-item"><div class="stripe"></div><a href=""><span>Data Search</span></a></li>
                    <li class="menu-item"><a href=""><span>Volcano Comparison</span></a></li>
                    <li class="menu-item"><a href=""><span>Eruption Interactive</span></a></li>
                </ul>
        </div>
    </div>
</div>
<!-- <div id="headershadow">
    <div id="headerspacer"></div>
    <div id="headerspacer1"></div>
    <div id="header1">
	<div id="wovologo">
	</div>
        <div align="left" id="wovodatlogo">
            <a href="http://www.wovodat.org/" target="_parent"><b><span style="font-family:lucida,sans-serif; font-size:32px; color:#0005b2;">WOVOdat</span></b><span style="font-family:lucida,sans-serif; font-size:12px; color:#fdfdfd;"> &nbsp ...A Database of Volcanic Unrest</span></a>
        </div>
        <div id="eoslogo">
            <a href="http://www.earthobservatory.sg/" target="_blank">
            </a>   
        </div>

        <div align="left" id="silogo">
            <a href="http://www.volcano.si.edu/" target="_blank">
	    </a>
        </div>
    </div>
    <div id="header2">
        <div style="float:right">
            <ul>
                <?php
                /*if (isset($_SESSION['login'])) {
                    ?>
                    <li>
                        <a href="/populate/my_account.php"><?php 
                        $n = $_SESSION['login']['cr_uname'];
                        $l = strlen($n);
                        if($l > 12) $n = substr($n,0,12) . '...';
                        echo $n; 
                        ?></a>
                    </li>
                    <li>
                        <a href="/populate/logout.php">Logout</a>
                    </li>
                    <?php
                } else {
                    ?>

                    <li>
                        <a href="/populate/index.php">Login</a>
                    </li>
                    <?php
                }
                */ ?>

            </ul>
        </div>
        <div id="wovodatMenu">
            <script type="text/javascript">cmDraw('wovodatMenu',wovodatMenu,'hbr', cmThemeOffice);</script>

        </div>		


    </div>
</div> -->