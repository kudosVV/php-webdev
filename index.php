

<!DOCTYPE html>
<html>
<body>
 
<?php
define("firstname", "Randall Kopp");
$bestquote = "I am, somehow, less interested in the weight and convolutions of Einstein’s brain <br> than in the near certainty that people of equal talent have lived  and died <br> in cotton fields and sweatshops. - Steven Jay Gould";
echo "Hello, and Welcome to my Website!! <br>";
echo "I have taken this class because I have an interest in computer programming. <br>";
echo "Quote - \"$bestquote\" <br>";

echo "My name is ";
echo firstname;
echo "<br>";
$name = "Brookhaven College";
$address = "3939 Valley View Ln";
$city = "Farmers Branch";
$zip = "75244";
$combined = $name . "<br>" . $address. "<br>" . $city . ' ' . $zip;
echo "The address block is <br>";
echo $combined;
echo "<br>";
$x = 5;
$y = 3;
$addition = $x + $y;
print "x + y is <br>";
$adtotal = $x . " + " . $y . " = " . "<br>" . $addition;
print $adtotal;
print "<br>";
echo "x * y is <br>";
$multitotal = $x * $y;
$multi2 = $x . " * " . $y . " = " . "<br>" . $multitotal;
print $multi2;
print "<br>";
print "x / y is <br>";
$div = $x/$y;
$modulus = $x%$y;
$divtotal =  $x . " / " . $y . " = " . "<br>" . $div;
$modtotal =   $x . " % " . $y . " = " . "<br>" . $modulus;
print $divtotal;
print "<br>";
print "x % y is <br>";
print $modtotal;
$whatfile= $_SERVER['SCRIPT_NAME'];
echo "<br>";
echo "The script file is ";
echo "<br>";
echo $whatfile;














// This is a single line comment

# this is also a type of comment

/* This is a multi-line
comment */






?>

</body>
</html>