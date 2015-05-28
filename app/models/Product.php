<?php

class Product extends Eloquent {
    
    public function orders() {
        return $this->hasMany('OrderItem', 'productId');
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getPrice() {
        return round($this->price, 2);
    }
    
    public function getOldPrice() {
        return round($this->old_price, 2);
    }
    
    public function getAvailableQuantity($orderId = NULL) {
        $ordered_quantity = 0;
        $orderItems = new OrderItem();
        $orderItems = $orderItems->where('productId', $this->id);
        if($orderId != NULL) {
            $orderItems->where('orderId', '<>', $orderId);
        }
        $orderItems = $orderItems->get();
        if($orderItems->count() > 0) {
            foreach($orderItems as $item) {
                $ordered_quantity += $item->quantity;
            }
        }
        return ($this->quantity - $ordered_quantity);
    }
    
    public function getCategory() {
        return $this->catId;
    }
    
    public function getCategoryName() {
        $category = Category::find($this->catId);
        return ($category != NULL) ? ucfirst($category->name) : "";
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function setPrice($price) {
        $this->price = $price;
    }
    
    public function setOldPrice($oldPrice) {
        $this->old_price = $oldPrice;
    }
    
    public function setAvailableQuantity($quantity) {
        $this->quantity = $quantity;
    }
}
