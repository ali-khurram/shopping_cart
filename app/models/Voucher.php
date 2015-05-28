<?php

class Voucher extends Eloquent {
    
    public function getSpecialCondition() {
        return ($this->special_condition != "") ? json_decode($this->special_condition) : "";
    }
    
    public function getMinimumBasket() {
        return $this->min_basket;
    }
    
    public function getDiscountAmount() {
        return $this->discount_amount;
    }
    
}
