# shopping_cart
Shopping cart testing application fulfilling test cases from the requirement specification

## Installation

Install the package through [Composer](http://getcomposer.org/). Edit your project's `composer.json` file by adding (if not included):

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



The shopping cart, based on the tasks specifications, is a strip down version mainly focusing on the priority list provided. 
It is mainly focusing on product listing and shopping basket which may not fully comply with the specifications of real time shopping cart application in general practice. 
For a general shopping cart, the order is first created within a temporary table also called session holding table, and real order is only created along with ordering quantity update once payment is confirmed. 
As there is no payment method included, I presumed all orders are complete as I am updating the stock quantity directly within the database. 

As the purpose of this application is to fulfill the priority list and with limited time frame available, I had to focus on minimum functionality.
The application is mainly comprised of two pages, "Product List" and "My Cart".

## Understanding the Functionality
