<?php

class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    // Default metas
    protected function metas() {
        $this->layout->title = 'Shopping Cart';
        $this->layout->site = 'Skeleton site for shopping cart';
        $this->layout->description = 'A cart that fulfills required criteria';
        $this->layout->keywords = 'shopping, cart, ecommerce';
    }

    /**
     * Calculate total of all items in the basket
     * 
     * @param  object  $items   List of all items in the cart
     */
    public function calculateTotal($items) {
        $total = 0.00;
        foreach ($items as $item) {
            $total += ($item->products->getPrice() * $item->getQuantity());
        }
        return $total;
    }

}
