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
    $userNameError = '<div class="p-3 mb-2 bg-danger text-white">Username required</div>';
} else {
$userName = $_POST['userName'];
$userNameError = NULL;
}
if(empty($_POST['quantity'])) {
$quantity = NULL;
$userQuantityError = '<div class="p-3 mb-2 bg-danger text-white">Quantity required</div>';
} else { 
    $quantity = $_POST['quantity'];
    $userQuantityError = NULL;
}
if(!isset($_POST['media'])) {
    $media = NULL;
    $userMediaError = '<div class="p-3 mb-2 bg-danger text-white">Media required</div>';
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
<a href="invoice.php"><button type="button">Back</button></a>

HERE;

include 'template.php';