

<?php

$shipping = 2.99;
$downloadPrice = 9.99;
$cdPrice = 12.99;
$heading = "Cost by Quantity";

$name = $_POST['fname'];
$radiobutton = $_POST['flexRadioDefault'];
$albumChosen = $_POST['albumPicked'];
$numAlbum = $_POST['num'];
$cdvalue = $numAlbum * 12.99 + 2.99;
$dlvalue = $numAlbum * 9.99;


echo 'Hello, '.$name;
echo '<br> <br>';
echo 'Welcome to the store!!';

echo '<br> <br>';

echo 'You chose the album ' .$albumChosen;

echo '<br> <br>';

echo 'You chose ' .$numAlbum. ' albums';


echo '<br> <br>';

echo 'You have picked in the form of ' .$radiobutton;

echo '<br> <br>';

if ($radiobutton == "CD") {
    echo 'The cost is $'  .$cdvalue ;
}
    elseif($radiobutton == "Download") {
        echo 'The cost is $' .$dlvalue;
    
}

echo '<br> <br>';
echo '<h3>' .$heading;
echo '</h3>';
echo 'CD cost $12.99 each and $2.99 for shipping';
echo '<br> <br>';
echo 'Download is 9.99 per';

?>