<?php

class Order extends Eloquent {
    
    public function getUserId() {
        return $this->user_id;
    }
    
    public function getActiveStatus() {
        return ($this->is_active == TRUE || $this->is_active == NULL) ? TRUE : FALSE;
    }
    
    public function setUserId($userId) {
        $this->user_id = $userId;
    }
    
    public function setVoucher($code) {
        $this->voucher = $code;
    }
    
    public function setAmount($amount) {
        $this->amount = (float)$amount;
    }
}
