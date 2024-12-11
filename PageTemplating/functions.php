<?php
function priceCalc($price, $quantity) {
        if ($quantity > 5) {
            $quantityIndex = 5;
        } else {
            $quantityIndex = $quantity;
        }
    $discountPercent = array(1=>0,.05,.1,.2,.25);
    $discountPrice = $price - ($price * $discountPercent[$quantity]);
    $total = $quantity * $discountPrice;
    $total = ROUND($total, 2);
    return $total;
}

?>