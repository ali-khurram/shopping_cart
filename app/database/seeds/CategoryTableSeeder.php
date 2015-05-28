<?php

    class CategoryTableSeeder extends Seeder {

        public function run() {

            $categories = array(
                "Women's Footwear",
                "Men's Footwear",
                "Women's Casualwear",
                "Men's Casualwear",
                "Women's Formalwear",
                "Men's Formalwear",
            );

            Category::truncate();

            foreach($categories as $category) {
                Category::create (
                        array('name' => $category)
                );
            }
        }
    }