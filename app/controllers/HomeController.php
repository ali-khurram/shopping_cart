<?php

class HomeController extends BaseController {
    
        /**
	 * Define default view for blade template
	 *
	 */
        protected $layout = 'layouts.default';
	
	/**
	 * Lists products on the landing page
         * 
         * Same function handling Get and Post requests
	 */
        public function index()
	{
            $result = $this->getProducts(Input::all());
            $order = $this->getOrder();
            $items = ($order) ? $this->getTotalItems($order) : 0;
            
            $variables = array('products' => $result['products'], 
                               'items' => $items,
                               'orderId' => ($order) ? $order->id : NULL,
                               'filters' => $result['filters']);
            
            $this->layout->content = View::make('products.index')->with($variables);
	}
        
        /**
	 * Get the products from the database
         * 
         * @param  array  $filters   Value is optional
         * @return array  $result    Array of products and filters
	 */
        private function getProducts($filters = NULL) {
            $supplied_filters = array();
            $products = new Product();
            if (!empty($filters)) {
                if(!empty($filters['cat-filter'])) {
                    $products =  $products->where('catId', Input::get('cat-filter'));
                    $supplied_filters['cat-filter'] = Input::get('cat-filter');
                }
            }
            $products = $products->get();
            $result = array('products' => $products, 'filters' => $supplied_filters);
            return $result;
        }
        
        /**
	 * Return any existing order of current session
         * 
         * @return Order|NULL  $order|NULL    Object of type Order|NULL
	 */
        private function getOrder() {
            if(Session::getId()) {
                $order = Order::where('user_id', Session::getId())->first();
                return $order;
            }
            return NULL;
        }
        
        /**
	 * Returns total items count in the session cart
         * 
         * @return int  Total number of items in a basket
	 */
        private function getTotalItems($order) {
            $orderId = $order->id;
            $order_items = OrderItem::where('orderId', $order->id)->get();
            if($order_items)
                return $order_items->count();
            return 0;
        }

}
