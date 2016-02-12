<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
        <meta name="keywords" content="Volcano, Vulcano, Volcanoes">
        <link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
        <link href="/css/index.css" rel="stylesheet" type="text/css">
        <link href="/css/normalize.css" rel="stylesheet" type="text/css">
    </head>

    <body>     
        <div class="body">
            <!--Header-->
            <?php include 'php/include/header.php'; ?>
            <!-- Content -->
            <div class="container">
                <div class="content">
                    <table>
                        <tr>
                            <td class="welcome">
                                <h1>Documentation</h1> 
                                <p>
                                    <span style = "font-size:13px">
                                        WOVOdat Database uses formats and data structure as described in <a href="doc/database/1.0/wovodat10_doc.pdf" title="download WOVOdat pdf 1.0 file" target="_blank" style = "color:blue">WOVOdat1.0 (Venezky and Newhall, 2007)</a>. The current version is WOVOdat1.1. The overall structure was retained from v1.0 to v1.1; most changes are in the details of parameters.<br><br>
                                        We use MySQL database system, and convert all submitted data into xml-format (WOVOml). </span>
                                    </p><br>
                                <p><img src="/gif2/flowschema3a.png" width="410" height="308" alt="schema"></p>
                                <br>
                                <p> Details of data flow. From observatories submitting various data formats, through XML conversions with standardized terms, then upload and store into WOVOdat server.</p>
                            </td>
                            <td valign = "top">
                                <div class="download" >
                                    <h3 style="padding:0px 35px 0px 20px;text-decoration: underline;">User Manual</h3>
                                    <ul>
                                        <li><p> WOVOdat database Documentation/ Manual </p></li>
                                        <p >WOVOdat1.1 Manual <a href="/doc/database/1.1/wovodat11_doc.pdf" title="download WOVOdat pdf file" target="_blank">(pdf)</a>
                                        </p>
                                        <li><p> Detail description of WOVOdat Tables </p> </li>
                                        <p >WOVOdat1.1 Tables<a href="/doc/database/1.1/index.php" title="view WOVOdat Table on-line">(online view)</a>
                                        </p>
                                        <li> <p>Introduction how to use WOVOdat </p></li>
                                        <p>Introduction to using WOVOdat <a href="/doc/system/IntroductionToUseWOVOda_Feb2014.pdf" title="view WOVOdat Introduction" target="_blank">(pdf)</a>
                                        </p>
                                    </ul>
                                    <h3 style="padding:10px 35px 0px 20px;text-decoration: underline;">Database schema and structure</h3>
                                    <ul>
                                        <li><p>WOVOdat Schema xsd</p>
                                        <p>WOVOml1.1.0 Schema <a href="/doc/system/1.1.0/wovoml_schema.xsd" title="view WOVOml descriptions" title="view WOVOml descriptions" target="_blank">(online view)</a>
                                        </p>
                                        </li>
                                        <li><p>WOVOdat structure in XML format and their related MySQL's attributes</p>
                                            <p>WOVOdat XML <a href="/doc/system/1.1.0/wovoml_110.php" title="view WOVOml upload descriptions">(online view)</a>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Content -->
            <!-- Footer -->
            <?php include 'php/include/footer.php'; ?>

        </div>
    </body>
</html>