<?PHP
$counterstyle = "text";     # Enter images or text
$imagetype = "2";           # 1 to 10 = The type of image to display (SEE README FILE)


$hitslog = "hits.txt";      # Path to the hits file, leave alone if in the same directory
$imagefolder = "countMe/digits";    # The full path to the images directory.
## Get the hitslog file ready

$hits = file($hitslog);
if($hits != false)  // only plus one and write when there is no read error.
{
    $hits = $hits[0] + 1;
    $fp = fopen($hitslog, "w");
    fwrite($fp, $hits);
}


## Text counter, print the number of hits
if ($counterstyle == "text") { print "<span style='font-family:palatino;'>You are visitor number: <b>$hits</b></span>"; }

## If Image Counter, get the required type and print them out.
if ($counterstyle == "images") {

    $digit = strval($hits);

 
	for ($i = 0; $i < strlen($hits); $i++) {
	print "<img src=\"/$imagefolder/$imagetype/$digit[$i].gif\" alt=\"There have been $hits visitors to this website\"> ";
	 }
}
## That's All Folks, more free simple scripts online at www.stevedawson.com
?>
