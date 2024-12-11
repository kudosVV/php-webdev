<?php
$shipping = 2.99;
$downloadPrice = 9.99;
$cdPrice = 12.99;
$heading = "Cost by Quantity";
$pageContent = NULL;
$orderList = NULL;
include 'functions.php';


if(empty($_POST['userName'])) {
    $userName = "Guest";
    $userNameError = "<p class='error'>Username required</p>";
} else {
$userName = $_POST['userName'];
$userNameError = NULL;
}
if(empty($_POST['quantity'])) {
$quantity = NULL;
$userQuantityError = "<p class='error'>Quantity required</p>";
} else { 
    $quantity = $_POST['quantity'];
    $userQuantityError = NULL;
}
if(!isset($_POST['media'])) {
    $media = NULL;
    $userMediaError = "<p class='error'>Media required</p>";
} else {
    $media = $_POST['media'];
    $userMediaError = NULL;
}

if($media == 'cd') {
$heading .= " - CDs";
for($i = 1; $i <= $quantity; $i++) {
    $cost = priceCalc($cdPrice, $i) + $shipping;
    $orderList .= "<p>The price for $i CDs is \$ $cost</p>";
    
}
}
if($media == 'download') {
    $heading .= " - Downloads";
    $i = 1;
    while ($i <= $quantity) {
        $cost = priceCalc($downloadPrice, $i);
        $orderList .= "<p>The price for $i Downloads is \$ $cost</p>";
        $i++;
    }
}

$pageContent = <<< HERE
    <section>
    <h2>$heading</h2>
    <article>
        <h3>Order for $username</h3>
        $orderList
        $usernameError
        $userQuantityError
        $userMediaError
    </article>
    </section>


HERE;

include 'template.php';