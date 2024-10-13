
<!DOCTYPE html>
<html>
<head>
<?php
$shipping = 2.99;

$heading = "Cost by Quantity";

$name = $_POST['fname'];
$radiobutton = $_POST['flexRadioDefault'];
$albumChosen = $_POST['albumPicked'];
$quantity = $_POST['num'];
if (!empty($_REQUEST['fname'])) {
    $name = $_REQUEST['fname'];
} else {
    $name = NULL;
}

if (!empty($_REQUEST['flexRadioDefault'])) {
    $radiobutton = $_REQUEST['flexRadioDefault'];
} else {
    $name = NULL;
}

if (!empty($_REQUEST['albumPicked'])) {
    $albumChosen = $_REQUEST['albumPicked'];
} else {
    $name = NULL;
}
if (!empty($_REQUEST['num'])) {
    $quantity = $_REQUEST['num'];
} else {
    $name = NULL;
}


$page_title = 'Welcome, to the form results page';
include('template.php');



include('functions.php');




?>
</head>

<?php


echo '<center>';


echo 'Hello, '.$name;
echo '<br> <br>';
echo 'Welcome to the store!!';

echo '<br> <br>';

echo 'You chose the album ' .$albumChosen;

echo '<br> <br>';

echo 'You chose ' .$quantity. ' albums';


echo '<br> <br>';

echo 'You have picked in the form of ' .$radiobutton;

echo '<br> <br>';




echo 'the final cost is $';

if ($radiobutton == "CD") {
    $price = 12.99;
   echo priceCalc($price, $quantity) + 2.99;
}
    elseif($radiobutton == "Download") {
        $price = 9.99;
        echo priceCalc($price, $quantity);
        
    
}







echo '<br> <br>';
echo '<h3>' .$heading;
echo '</h3>';
echo 'CD cost $12.99 each and $2.99 for shipping';
echo '<br> <br>';
echo 'Download is 9.99 per';
echo '<br> <br>';
echo 'There are discounts based on the quantity you buy ';
echo '<br> <br>';
echo 'The more you buy, the better the discount ';
echo '</center>';
?>
