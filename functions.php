

<?php






function priceCalc($price, $quantity) {

$discounts = array(0, 0, 0.05, 0.1, 0.2, 0.25);


    if ($quantity <= 1 ) {
    $discountedPrice = $price - ($price * $discounts[0]);
    $totalPrice = $quantity * $discountedPrice;
    return $totalPrice;
    }
    if ($quantity == 2) {

        $discountedPrice = $price - ($price * $discounts[2]);
        $totalPrice = $quantity * $discountedPrice;
        return $totalPrice;
        
    }
    if ($quantity == 3) {
        $discountedPrice =  $price - ($price * $discounts[3]);
        $totalPrice = $quantity * $discountedPrice;
        return $totalPrice;
        
        
    }
    if ($quantity == 4) {
        $discountedPrice =  $price - ($price * $discounts[4]);
        $totalPrice = $quantity * $discountedPrice;
        return $totalPrice;
       

    }
    if ($quantity >= 5) {
        $discountedPrice =  $price - ($price * $discounts[5]);
        $totalPrice = $quantity * $discountedPrice;
        return $totalPrice;
        

    }
}


?> 
