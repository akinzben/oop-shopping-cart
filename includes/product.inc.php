<?php
class Product {

    // Set Product Properties
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $weight;

    // Constructor populates the attributes:
    public function __construct($id, $name, $description, $price, $weight) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->weight = $weight;
    }

    // Method that returns the ID:
    public function getId() {
        return $this->id;
    }

    // Method that returns the name:
    public function getName() {
        return $this->name;
    }

    // Method that returns the description:
    public function getDescription() {
        return $this->description;
    }

    // Method that returns the price:
    public function getPrice() {
        return $this->price;
    }

    // Method that returns the weight:
    public function getWeight() {
        return $this->weight;
    }


} // End of Product class.
?>