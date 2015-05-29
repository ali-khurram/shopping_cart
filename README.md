# shopping_cart
Shopping cart testing application fulfilling test cases from the requirement specification

## Installation

Install the package through [Composer](http://getcomposer.org/). Edit your project's `composer.json` file by adding:

### Laravel 4.2 and below

```php
"require": {
	"laravel/framework": "4.2.*"
}
```

Next, run the Composer update command from the Terminal:

    composer update

Now all you have to do is point the virtual host to this path `shopping_cart/public`

Now you're ready to use shopping cart application.

## Overview of my approach

The shopping cart is a strip down version mainly focusing on the task list and requirements 
provided. It is mainly focusing on product list and shopping cart and may not fulfill 
the actual shopping cart specification. I do understand how to manage a real time shopping cart but 
this application presumes all user journeys are complete as I am updating the stock quantity in real
time. As the purpose of this application is to fulfill the task list and with time frame available, 
I had to focus on minimum functionality.

The application is mainly comprised of two pages, "Product List" and "My Cart".

## Understanding the Functionality
