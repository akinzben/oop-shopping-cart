<?php
class Cart implements Iterator, Countable {

    // Array stores the list of products in the cart:
    protected $products = array();

    // For tracking iterations:
    protected $position = 0;

    // For storing the IDs, as a convenience:
    protected $ids = array();

    // Constructor just sets the object up for usage:
    function __construct() {
        $this->products = array();
        $this->ids = array();
    }

    // Returns a Boolean indicating if the cart is empty:
    public function isEmpty() {
        return (empty($this->products));
    }

    // Adds a new product to the cart:
    public function addProduct(Product $product) {

        // Need the product id:
        $id = $product->getId();

        // Throw an exception if there's no id:
        if (!$id) throw new Exception('The cart requires products with unique ID
        values.');

        // Add or update:
        if (isset($this->products[$id])) {
            $this->updateProduct($product, $this->products[$product]['qty'] + 1);
        } else {
            $this->products[$id] = array('product' => $product, 'qty' => 1);
            $this->ids[] = $id; // Store the id, too!
        }

    } // End of addProduct() method.

    // Changes product already in the cart:
    public function updateProduct(Product $product, $qty) {

        // Need the unique product id:
        $id = $product->getId();

        // Delete or update accordingly:
        if ($qty === 0) {
            $this->deleteProduct($product);
        } elseif ( ($qty > 0) && ($qty != $this->products[$id]['qty'])) {
            $this->products[$id]['qty'] = $qty;
        }

    } // End of updateProduct() method.

    // Removes product from the cart:
    public function deleteProduct(Product $product) {

        // Need the unique product id:
        $id = $product->getId();

        // Remove it:
        if (isset($this->products[$id])) {
            unset($this->products[$id]);

            // Remove the stored id, too:
            $index = array_search($id, $this->ids);
            unset($this->ids[$index]);

            // Recreate that array to prevent holes:
            $this->ids = array_values($this->ids);

        }
    
    } // End of deleteProduct() method.



    // Calculate and display Cart Shipping Cost
    public function shippingCost() {

        $shippingCost=0;

        foreach ($this->products AS $arr) {
            $prID = $arr['product'];
            $prQTY = $arr['qty'];
            $prWEIGHT = $prID->getWeight();
            //get shipping cost for weight of each product
            $weightShipping = 1*$prWEIGHT*$prQTY;
            $shippingCost=number_format($shippingCost + $weightShipping,2);
        
        } // End of foreach loop!

        return $shippingCost;

    } // End of shippingCost() method.



    // Calculate and display Cart Total Price
    public function cartTotalPrice() {

        $total_price=0;

        foreach ($this->products AS $arr) {
            $prID = $arr['product'];
            $prQTY = $arr['qty'];
            $prPRICE = $prID->getPrice();
            $product_cost = $prPRICE * $prQTY;
            $total_price = $total_price + $product_cost;
        
        } // End of foreach loop!

        return $total_price;

    } // End of cartTotalPrice() method.

    // Required by Iterator; returns the current value:
    public function current() {

        // Get the index for the current position:
        $index = $this->ids[$this->position];

        // Return the product:
        return $this->products[$index];

    } // End of current() method.

    // Required by Iterator; returns the current key:
    public function key() {
        return $this->position;
    }

    // Required by Iterator; increments the position:
    public function next() {
    $this->position++;
    }

    // Required by Iterator; returns the position to the first spot:
    public function rewind() {
    $this->position = 0;
    }

    public function valid() {
    return (isset($this->ids[$this->position]));
    }

   // Required by Countable:
   public function count() {
    return count($this->products);
   }

} // End of Cart class.
?>