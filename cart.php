<style>
    td,th{
        padding:20px 30px;
        border:1px solid #000;
    }
</style>
<?php
// Create the cart:
try {

require('includes/cart.inc.php');
$cart = new Cart();

// Create some products:
require('includes/product.inc.php');
$p1 = new Product('P2365', 'Product 1', 'This is product 1', 23.45, 4);
$p2 = new Product('P0283', 'Product 2', 'This is product 2',12.39, 9);
$p3 = new Product('P8274', 'Product 3', 'This is product 3', 5.00, 6);

// Add the products to the cart:
$cart->addProduct($p1);
$cart->addProduct($p2);
$cart->addProduct($p3);

// Update some quantities:
$cart->updateProduct($p2, 4);
$cart->updateProduct($p1, 1);

// Delete a product:
$cart->deleteProduct($p3);
echo "<center><h2>West Midlands Media OOP Exercise</h2></center> <hr>";
// Show the cart contents:
echo '<h2>Products in Cart (' . count($cart) . ' products)</h2>';



if (!$cart->isEmpty()) {

    echo "<table>
            <tr>
                <th>Product Info</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
    ";
foreach ($cart as $arr) {

    // Get the product object:
    $product = $arr['product'];

    // Print the product:
    echo "<tr>";
    echo "<td>".$product->getName()."<br><i>£".$product->getPrice()."<br>".$product->getWeight()."kg</i></td>";
    echo "<td>".$arr['qty']."</td>";
    echo "<td>£".$product->getPrice() * $arr['qty']."</td>";
    echo "</tr>";
    
    

} // End of foreach loop!

$products_cost=$cart->cartTotalPrice();
$shipping_cost=$cart->shippingCost();

$total_cost=$products_cost + $shipping_cost;

echo "
        <tr>
                <th></th>
                <th></th>
                <th style='font-size:18px;'> £".$products_cost."</th>
            </tr>
</table>";


echo "<br><br><b>Shipping Cost = </b> £".$shipping_cost." @ £1/kg";
echo "<br><br>";
echo "<span style='font-size:20px;'><b>Total Payment  = </b> £".$total_cost."</span>";




} // End of IF.



} catch (Exception $e) {
// Handle the exception.
}
?>