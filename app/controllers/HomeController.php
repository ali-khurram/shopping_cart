<?php

class HomeController extends BaseController {
        protected $layout = 'layouts.default';
	
	public function index()
	{
            $supplied_filters = array();
            $products = new Product();
            if (Input::has('cat-filter')) {
                 $products =  $products->where('catId', Input::get('cat-filter'));
                 $supplied_filters['cat-filter'] = Input::get('cat-filter');
            }
            $products = $products->get();
            $items = 0;
            $orderId = NULL;
            if(Session::getId()) {
                $order = Order::where('user_id', Session::getId())->first();
                if($order) {
                    $orderId = $order->id;
                    $order_items = OrderItem::where('orderId', $order->id)->get();
                    if($order_items)
                        $items = $order_items->count();
                }
            }
            
            $this->layout->content = View::make('products.index')
                                ->with(array('products' => $products, 
                                        'items' => $items,
                                        'orderId' => $orderId,
                                        'filters' => $supplied_filters));
	}

}
