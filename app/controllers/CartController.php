<?php

class CartController extends BaseController {
    
    /**
    * Define default view for blade template
    *
    */
    protected $layout = 'layouts.default';
    
        
    /**
     * Add product to the cart
     * 
     * @param  int  $product_id   ID of the product to be added to cart
     * @return Redirects to product list page
     */
    public function addItem($product_id) {
        
        $product = Product::where('id', $product_id)->first();
        
        if ($product->getAvailableQuantity() > 0) {
            $userId = (Session::getId()) ? Session::getId() : Session::regenerate();
            $order = $this->getOrder($userId);
            $this->itemsHandler($order, $product_id);
        }
        
        return Redirect::to('/');
    }

    /**
     * Get existing or new order for user session
     * 
     * @param  string  $userId   Id of the user session
     * @return object  $order    Object of type Order
     */
    private function getOrder($userId) {
        $order = Order::where('user_id', $userId)->first();
        if (!$order || !$order->is_active) {
            $order = new Order();
            $userId = ($order->getActiveStatus()) ? $userId : (Session::regenerate());
            $order->setUserId($userId);
            $order->save();
        }
        
        return $order;
    }

    /**
     * Add new item or increment exisiting item in the cart
     * 
     * @param  object, int  $order, $product_id   Pass order object and the
     *                                            product id to be added
     */
    private function itemsHandler($order, $product_id) {
        $orderItem = OrderItem::where('orderId', $order->id)
                            ->where('productId', $product_id)->first();
        if (!$orderItem) {
            $orderItem = new OrderItem();
            $orderItem->setOrderId($order->id);
            $orderItem->setProductId($product_id);
            $orderItem->setQuantity($product_id);
        } else {
            $orderItem->setQuantity($product_id);
        }
        $orderItem->save();
    }

    /**
     * Display the cart with all products with quantity
     * 
     * @param  int  $orderId   Order Id of the order to be displayed
     */
    public function showBasket($orderId) {
        $orderItems = OrderItem::with('products')->where('orderId', $orderId)->get();
        $this->layout->content = View::make('cart.index')
                    ->with(array('items' => $orderItems, 
                                 'order_id' => $orderId, 
                                 'total' => $this->calculateTotal($orderItems)
                           ));
    }
    
    /**
     * Gets the quantity of the each products and update them to the database
     * 
     */
    public function updateBasket() {
        $orderDetails = Input::all();
        $error = FALSE;
        $orderItems = OrderItem::with('products')
                        ->where('orderId', $orderDetails['orderId'])->get();
        foreach ($orderItems as $item) {
            $availableQty = $item->products->getAvailableQuantity($orderDetails['orderId']);
            if ($orderDetails['qty-' . $item->products->id] > $availableQty) {
                $error = TRUE;
                $message = "Maximum stock available for: " . $item->products->getName() .
                        " is " . $availableQty;
                break;
            } else {
                $item->setDirectQuantity($orderDetails['qty-' . $item->products->id]);
            }
        }
        if (!$error) {
            foreach ($orderItems as $item) {
                $item->save();
            }
            return Redirect::to('/basket/' . $orderDetails['orderId']);
        }
        $variables = array('items' => $orderItems,
                           'total' => $this->calculateTotal($orderItems),
                           'order_id' => $orderDetails['orderId'],
                           'error_msg' => $message);
        
        $this->layout->content = View::make('cart.index')->with($variables);
    }

    /**
     * Remove product from the cart of passed object
     * 
     * @param  int,int  $order_id,$product_id   Product id to be removed from cart
     */
    public function deleteProduct($order_id, $product_id) {
        $orderItem = OrderItem::where('productId', $product_id)
                                    ->where('orderId', $order_id)->first();
        if ($orderItem) {
            $orderItem->delete();
        }
        return Redirect::to('/basket/' . $order_id);
    }

    /**
     * Checkout user journey by completing and updating current active order
     * 
     */
    public function checkout() {
        $inputs = Input::all();
        $order = Order::where('id', $inputs['orderId'])->first();
        $order->setAmount($inputs['total']);
        $order->is_active = FALSE;
        $order->save();
        Session::regenerate();
        
        return Redirect::to('/');
    }

}
