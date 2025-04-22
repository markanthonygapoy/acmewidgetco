# acmewidgetco
This repository is for Acme Widget Co's Sales System

Acme Widget Co are the leading provider of made up widgets and they’ve contracted you to
create a proof of concept for their new sales system.

They sell three products namely Red Widget, Green Widget and Blue Widget.
Each product has a corresponding price and description.

To incentivise customers to spend more, delivery costs are reduced based on the amount spend.
Orders under $50 costs $4.95, Under $90 costs $2.95 and $2.95 for orders more than $90 respectively.

They are also implementing Special Offers. The initial offer will be "buy one red widget, get the second half the price".


Here is how the code works:

in add-product.php, we initize the following:
1. Products
2. Delivery Rules
3. Offers

1. Products - Includes product code, description and pricing

$products = [
    'R01' => ['desc' => 'Red Widget','price' => 32.95],
    'G01' => ['desc' => 'Green Widget','price' => 24.95],
    'B01' => ['desc' => 'Blue Widget', 'price' => 7.95]
];

2. Delivery Rules - Includes delivery code, description and pricing

$delivery_rules = [
    'standard' => ['desc' => 'Standard Delivery | Under $50', 'price' => 4.95],
    'under90' => ['desc' => 'Under $90','price' => 2.95],
    'moreThan90' => ['desc' => 'Free Delivery','price' => 0]
];

3. Offers - Includes Promo Code and description
$offers = [
    'Buy1Red2ndHalf' => ['desc' => 'Buy 1 Red Widget, Get 2nd Half Price'],
    'Buy1Get1' => ['desc' => 'Buy 1 Get 1 Free']
];

After initializing the product, delivery rules and offers, functions for addToCart and getTotal is created.
For addToCart, it accepts multiple product codes. 
It loops over the items, initially validates if it is an existing product before proceeding.
Once found in the products lists, it adds the item into the "Cart".

If all items are added as per item code parameters, it now calculates for the total with getTotal function.
For the getTotal, it takes into consideration the delivery rules and offers tied to the item.

By looping into the products, the price is taken and added into calculation for the subtotal.
For some items like the Red Widget, it includes a promotion/offer where if a customer buy 1 red, the 2nd item is half price. After applying the offer, the code will now calculates for the delivery fee. It will first check the subtotal, now includes the offers, then it will have 3 conditions and apply the corresponding amount if the subtotal satisfies the condition.

The code ends with displaying the product codes and total.

To add items to cart, simply change the parameters in the function addToCart:

addToCart('R01', 'R01', 'G01', 'B01');

You may add additional items to cart by calling the function again with extra parameters.

To display the total, just call getTotal();

#### This code is written by Mark Gapoy at 10:11pm April 22 ####




