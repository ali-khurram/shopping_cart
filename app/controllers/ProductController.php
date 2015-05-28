<?php

class ProductController extends BaseController {
        protected $layout = 'layouts.default';

	public function showWelcome()
	{
		$this->layout->content = View::make('hello');
	}

}
