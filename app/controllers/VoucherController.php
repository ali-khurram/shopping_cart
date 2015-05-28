<?php

class VoucherController extends BaseController {
        protected $layout = 'layouts.default';

	public function addVoucher()
	{         
            $orderDetails = Input::all();
            $error = FALSE;
            $voucher = Voucher::where('code', $orderDetails['voucher_code'])->first();
            
            if($voucher == NULL) {
                $message = "Invalid Voucher Code";
                $error = TRUE;
            }
            
            $orderItems = OrderItem::with('products')
                    ->where('orderId', $orderDetails['orderId'])->get();
            
            $variables = array('items' => $orderItems,
                        'order_id' => $orderDetails['orderId'],
                        'code' => $orderDetails['voucher_code']);
                        
            if(!$error) {
                $discount = $this->voucher_evalautor($voucher, $orderItems);
                if($discount == 0)
                    $variables['error_msg'] = "Basket doesn't fulfill the voucher requirement.";
                else
                    $variables['discount'] = $discount;
                $order = Order::where('id', $orderDetails['orderId'])->first();
                $order->setVoucher($orderDetails['voucher_code']);
                $order->save();
            } else {
                $variables['error_msg'] = $message;
            }
            $this->layout->content = View::make('cart.index')->with($variables);
        }
        
        protected function voucher_evalautor($voucher, $orderItems) {
            $cart_total = 0.00;
            $check = TRUE;
            $products_cat = array();
            foreach($orderItems as $item) {
                $products_cat[] = $item->products->getCategory();
                $cart_total += ($item->products->getPrice() * $item->getQuantity());
            }
            
            if($voucher->getSpecialCondition() != "") {
                $condition = $voucher->getSpecialCondition();
                if (count(array_intersect($condition->catId, $products_cat)) == 0)
                        $check = FALSE;
            }
            
            return ($check && $cart_total > $voucher->getMinimumBasket()) 
                                        ? $voucher->getDiscountAmount() : 0;
        }
}
