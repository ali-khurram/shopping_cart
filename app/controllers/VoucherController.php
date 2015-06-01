<?php

class VoucherController extends BaseController {
    
        /**
	 * Define default view for blade template
	 *
	 */
        protected $layout = 'layouts.default';
        
        
        /**
	 * Apply voucher code to the cart/basket
         * 
	 */
	public function applyVoucher()
	{         
            $orderDetails = Input::all();
            $error = FALSE;
            $voucher = Voucher::where('code', $orderDetails['voucher_code'])->first();
            
            if(!$voucher) {
                $message = "Invalid Voucher Code";
                $error = TRUE;
            }
            
            $orderItems = OrderItem::with('products')
                            ->where('orderId', $orderDetails['orderId'])->get();
            
            $variables = array('items' => $orderItems,
                               'order_id' => $orderDetails['orderId'],
                               'total' => $this->calculateTotal($orderItems),
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
        
        /**
	 * Evaluate the discount value of the voucher on the ordered items
         * 
         * @param  object,object  $voucher,$orderItems   Voucher object to be applied
         *                                               on items in the cart
         * @return int  $discount    Return the discount applied amount
	 */        
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
