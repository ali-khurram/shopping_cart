<?php

class OrderItem extends Eloquent {
    protected $table = 'order_items';
    
    public function products() {
        return $this->belongsTo('Product', 'productId');
    }
    
    public function getOrderId() {
        return $this->orderId;        
    }
    
    public function getProductId() {
        return $this->productId;        
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function setOrderId($order_id) {
        $this->orderId = $order_id;            
    }
    
    public function setProductId($product_id) {
        $this->productId = $product_id;
    }
    
    public function setQuantity($product_id) {
        $current_qty = ($this->quantity == NULL) ? 0 : $this->quantity;
        $product = Product::where('id', $product_id)->first();
        if($current_qty < $product->getAvailableQuantity()) {
            $this->quantity = ++$current_qty;
        }
    }
    
    public function setDirectQuantity($qty) {
        $this->quantity = $qty;
    }
}
