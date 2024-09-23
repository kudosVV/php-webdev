<!DOCTYPE html>
<html>
<body>


<label>Here is a list in HTML select form</label>


<select name="Albums">;


<?php





$associativeAlbum = array("Chronic" => 5, "Blueprint" => 4, "AstroWorld" => 3, "Rodeo" => 4, "Utopia" => 5);
	
	$associativeAlbum["Abbey Road"] = 10;
	
	print_r($associativeAlbum);
	
	echo "<br>";
	
	ksort($associativeAlbum);
	
	foreach($associativeAlbum as $x=>$x_value)
	
	{
	echo "<option value=\"$x_value\">$x</option>";
	
	echo "<br>";
    }
 
    
    
?> 
 </select>
 <?php
 echo "<br>";
 echo "<br>";
 echo "These are the contents of the array: ";
 echo "<br>";
 print_r($associativeAlbum);
 
 $multiArray = array(
 	"The Beatles" => array("A Hard Day's Night" => "1964", "Hellp!" => "1965", "Rubber Soul" => "1965", "Abbey Road" => "1969"),
 	"LedZepplin" => array("Led Zepplin IV" => "1971"),
 	"Rolling Stones" => array("Let it Bleed" => "1969", "Sticky Fingers" => "1971"),
 	"The Who" => array("Tommy" => "1969", "Quadrophenia" => "1973", "The Who by Numbers" => "1975"));

echo "<br>";
echo "<br>";
	
 $pagecontent = $multiArray["The Who"]["Tommy"];
 
 echo "The release date for Tommy by The Who is " . $pagecontent;
 
 echo "<br>";
echo "<br>";
 
 foreach ($multiArray as $subArray => $albums) {
 	echo $subArray;
 	echo "<br>";
    foreach ($albums as $name => $year) {
    echo $name . "<br>";
    }
    echo "<p>";
 }
 
  echo "<br>";
echo "<br>";

echo "The list date for each album for the Who is ";
echo "<br>";
echo "<br>";

foreach($multiArray as $subArray => $albums) {
	if ($subArray == "The Who") {
	echo $subArray . "<br>";
	 foreach ($albums as $name => $year) {
    echo $name . "<br>";
    }
    echo "<p>";
	}
	
}

echo "The albums released later than 1970 are ";
echo "<br>";
echo "<br>";

foreach ($multiArray as $subArray => $albums)
foreach($albums as $name => $year) {
if ($year > 1970) {
	echo $name . "<br>";
	}

}

 ?>
 

 
 

</body>
</html>