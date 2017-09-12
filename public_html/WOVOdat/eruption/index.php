<?php
if (!isset($_SESSION))
    session_start();

include 'php/include/header.php';

include 'php/include/menu.php';

echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > Visualisation </a> >  Temporal Evolution of Unrest</div>";

?>
</div>  <!-- header-menu -->


<link href="css/style.css" rel="stylesheet">
<link href="css/materialize.css" rel="stylesheet">
<link href="css/icon.css" rel="stylesheet">
<link href="/css/tooltip.css" rel="stylesheet">
<div class="body">

    <div class="widecontent">

        <!-- content -->
        <div class="blue lighten-4 main">
            <div id="main" class="container">
            </div>
        </div>
        <script>

        </script>
        <script type="text/javascript" src="js/vendor/requirejs/require.js" data-main="js/main"></script>
        <!-- content -->

    </div>
</div>

<div class="footer">
    <?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->