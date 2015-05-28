<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( !is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
        
        // Default metas

        protected function metas()
        {
            $this->layout->title = 'Santander';
            $this->layout->site = 'Enterprise Portal';
            $this->layout->description = 'A dedicated tool for the university, start-up and small business communities';
            $this->layout->keywords = 'santander, universities, start-up, business, communities, portal, tool';
        }

}
