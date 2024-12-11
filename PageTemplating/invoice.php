<?php

$pageTitle = "Invoice";
$pageContent = NULL;
$albums = array("The White Album" => "The Beatles", "The Black Album" => "Jay-Z", "AstroWorld" => "Travis Scott",
"Cowboy Carter" => "Beyonce", "Abbey Road" => "The Beatles", "2Pacalypse Now" => "Tupac", "Stoney" => "Post Malone");


ksort($albums);
$albumsKeySortList = "<ul>";
foreach ($albums as $albumKeySort => $artistKeySort) {
    $albumsKeySortList .= "<li>$albumKeySort has a artist of $artistKeySort</li>\n";

}
$albumsKeySortList .= "</ul>";

asort($albums);
$albumsValueSortList="<ul>";
foreach ($albums as $albumValueSort => $artistValueSort) {
    $albumsValueSortList .= "<li>$albumValueSort has a artist of $artistValueSort</li>\n";
}
$albumsValueSortList .= "</ul>";

$albumsList = '<label for="album">Choose a Album</label><br>' . "\n";
$albumsList .= '<select name="album" id="album">' . "\n";


foreach ($albums as $album => $artist) {
$albumsList .= '<option value="' . $album . '">' . $album . '</option>' . "\n";
}
$albumsList .= '</select>' . "\n";


$pageContent .= <<< HERE
<section>
<p>Please make your selections from the
form below.</p> 
<fieldset>
<legend> Invoice Form </legend>
<form method="post" action="handle-invoice.php" class="card p-3 bg-light">
<p>
<label for="userName">Name</label><br>
<input type="text"
name="userName" id="userName" value="">
</p>
<p>
<label for="quantity">Quantity</label><br>
<input type="text" name="quantity" id="quantity" value="">
</p>
<p>$albumsList</p>
<p>
<label>Media</label><br>
<input type="radio" name="media" id="cd" value="cd">
<label for="cd">CD</label>&emsp;
<input type="radio" name="media" id="d1" value="download">
<label for="d1">Download</label>
</p>
<p>
<input type="submit" name="submit" value="Submit" class="btn btn-primary">
</p>
</form>
</fieldset>
<h3>Artists and Albums sorted by name.</h3>
$albumsKeySortList
<h3>Artists and Albums sorted by artist.</h3>
$albumsValueSortList
</section>
HERE;
include_once 'template.php';


?>