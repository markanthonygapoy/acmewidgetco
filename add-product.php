<?php

 // #### Initialize Products, Delivery Rules and Offers #### 
$products = [
    'R01' => ['desc' => 'Red Widget','price' => 32.95],
    'G01' => ['desc' => 'Green Widget','price' => 24.95],
    'B01' => ['desc' => 'Blue Widget', 'price' => 7.95]
];

$delivery_rules = [
    'standard' => ['desc' => 'Standard Delivery | Under $50', 'price' => 4.95],
    'under90' => ['desc' => 'Under $90','price' => 2.95],
    'moreThan90' => ['desc' => 'Free Delivery','price' => 0]
];

$offers = [
    'Buy1Red2ndHalf' => ['desc' => 'Buy 1 Red Widget, Get 2nd Half Price'],
    'Buy1Get1' => ['desc' => 'Buy 1 Get 1 Free']
];

// Cart array
$cart = [];

 // #### Add Items to Cart #### 
function addToCart(...$items) { // accept multiple items via callable syntax(...)
    global $cart, $products;
    
    foreach ($items as $code) {
        if (isset($products[$code])) {
            $cart[$code] = ($cart[$code] ?? 0) + 1;
            echo "Added $code to cart.<br/>";
        } else {
            echo "Product $code not found.<br/>";
        }
    }
}


// #### Get Total Price, take into account Delivery and Offers #### 
function getTotal() {
    global $cart, $products, $delivery_rules, $offers;
    $subtotal = 0;
    $productCodes = [];

    foreach ($cart as $code => $qty) {
        $price = $products[$code]['price'];
        $productCodes += array_fill(count($productCodes), $qty, $code); //Get 

        // #### Promotions #### 
        if ($code === 'R01' && isset($offers['Buy1Red2ndHalf'])) {//Add but 1 red get 2nd for half price
            $pairs = floor($qty / 2);
            $remainder = $qty % 2;
            $subtotal += $pairs * ($price + $price / 2) + $remainder * $price;
        } else {
            $subtotal += $qty * $price;
        }
    }

    // #### Delivery Fee Calculation #### 
    $delivery = 0;
    if ($subtotal >= 90) { //for more than 90, free delivery
        $delivery = $delivery_rules['moreThan90']['price']; //$0
    } elseif ($subtotal > 50 && $subtotal < 90) { 
        $delivery = $delivery_rules['under90']['price']; //$2.95
    } else {
        $delivery = $delivery_rules['standard']['price']; //standard 4.95
    }

    $total = round($subtotal + $delivery, 2);
    $productList = implode(', ', $productCodes);

    echo "Products: $productList\n";
    echo "Total: $" . number_format($total, 2) . "\n";
}

// #### Interface for Adding to Cart and Getting the Total: #### 

//Add to Cart
addToCart('R01', 'R01', 'G01', 'B01');

// Get Total
getTotal();

?>