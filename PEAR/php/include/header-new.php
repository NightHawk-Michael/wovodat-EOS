<?php
if (!isset($_SESSION))
    session_start();
?>
<!-- Nhat changed, 18 June 2015 -->
<script src="/js/menu.js"></script>
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
                            <a href="/populate/index.php"><span>Register | Login</span></a>
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
                    <li class="menu-item"><div class="stripe"></div><a href="/boolean/booleanIndex.php"><span>Data Search</span></a></li>
                    <li class="menu-item"><a href="/precursor/index_unrest_devel_v5.php"><span>Volcano Comparison</span></a></li>
                    <li class="menu-item"><a href="/eruption"><span>Eruption Interactive</span></a></li>
                </ul>
        </div>
    </div>
</div>