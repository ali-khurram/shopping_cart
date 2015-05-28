<?php

    class ProductTableSeeder extends Seeder {

        public function run() {

            $products = array(
                array( 'name' => 'Almond Toe Court Shoes, Patent Black',
                       'price' => 99.00,
                       'quantity' => 5,
                       'catId' => 1),                
                array( 'name' => 'Suede Shoes, Blue',
                       'price' => 42.00,
                       'quantity' => 4,
                       'catId' => 1),                
                array( 'name' => 'Leather Driver Saddle Loafers, Tan',
                       'price' => 34.00,
                       'quantity' => 12,
                       'catId' => 2),                
                array( 'name' => 'Flip Flops, Red',
                       'price' => 19.00,
                       'quantity' => 6,
                       'catId' => 2),
                array( 'name' => 'Flip Flops, Blue',
                       'price' => 19.00,
                       'quantity' => 0,
                       'catId' => 2),
                array( 'name' => 'Gold Button Cardigan, Black',
                       'price' => 167.00,
                       'quantity' => 6,
                       'catId' => 3),
                array( 'name' => 'Cotton Shorts, Medium Red',
                       'price' => 30.00,
                       'quantity' => 5,
                       'catId' => 3),
                array( 'name' => 'Fine Stripe Short Sleeve Shirt, Grey',
                       'price' => 49.99,
                       'quantity' => 9,
                       'catId' => 4),
                array( 'name' => 'Fine Stripe Short Sleeve Shirt, Green',
                       'price' => 39.99,
                       'old_price' => 49.99,
                       'quantity' => 3,
                       'catId' => 4),
                array( 'name' => 'Sharkskin Waistcoat, Charcoal',
                       'price' => 75.00,
                       'quantity' => 2,
                       'catId' => 6),
                array( 'name' => 'Lightweight Patch Pocket Blazer, Deer',
                       'price' => 175.50,
                       'quantity' => 1,
                       'catId' => 6),
                array( 'name' => 'Bird Print Dress, Black',
                       'price' => 270.00,
                       'quantity' => 10,
                       'catId' => 5),
                array( 'name' => 'Mid Twist Cut-Out Dress, Pink',
                       'price' => 540.00,
                       'quantity' => 5,
                       'catId' => 5)
            );

            Product::truncate();

            foreach($products as $product) {
                Product::create ($product);
            }
        }
    }