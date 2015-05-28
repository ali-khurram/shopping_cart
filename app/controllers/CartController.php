<?php

class CartController extends BaseController {

    protected $layout = 'layouts.default';

    public function addItem($product_id) {
        $product = Product::where('id', $product_id)->first();
        if ($product->getAvailableQuantity() > 0) {
            $userId = (Session::getId()) ? Session::getId() : Session::regenerate();

            $order = Order::where('user_id', $userId)->first();
            if ($order == NULL || !$order->is_active) {
                $order = new Order();
                $userId = ($order->getActiveStatus()) ? $userId : (Session::regenerate());
                $order->setUserId($userId);
                $order->save();
            }
            $orderItem = OrderItem::where('orderId', $order->id)
                            ->where('productId', $product_id)->first();
            if ($orderItem == NULL) {
                $orderItem = new OrderItem();
                $orderItem->setOrderId($order->id);
                $orderItem->setProductId($product_id);
                $orderItem->setQuantity($product_id);
            } else {
                $orderItem->setQuantity($product_id);
            }
            $orderItem->save();
        }
        return Redirect::to('/');
    }

    public function showBasket($orderId) {
        $orderItems = OrderItem::with('products')->where('orderId', $orderId)->get();
        $this->layout->content = View::make('cart.index')->with(array('items' => $orderItems,
            'order_id' => $orderId));
    }

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
            'order_id' => $orderDetails['orderId'],
            'error_msg' => $message);
        $this->layout->content = View::make('cart.index')->with($variables);
    }

    public function deleteProduct($order_id, $product_id) {
        $orderItem = OrderItem::where('productId', $product_id)->where('orderId', $order_id)->first();
        if ($orderItem != NULL) {
            $orderItem->delete();
        }
        return Redirect::to('/basket/' . $order_id);
    }
    
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
