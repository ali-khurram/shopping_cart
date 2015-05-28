<?php

    class VoucherTableSeeder extends Seeder {

        public function run() {

            $vouchers = array(
                array( 'code' => 'DISCOUNT5',
                       'min_basket' => 0.00,
                       'discount_amount' => 5.00,
                       'discount_type' => '£',
                       'special_condition' => ''),
                array( 'code' => 'DISCOUNT10',
                       'min_basket' => 50.00,
                       'discount_amount' => 10.00,
                       'discount_type' => '£',
                       'special_condition' => ''),
                array( 'code' => 'DISCOUNT15',
                       'min_basket' => 75.00,
                       'discount_amount' => 15.00,
                       'discount_type' => '£',
                       'special_condition' => json_encode(array('catId' => array(1,2))))
            );

            Voucher::truncate();

            foreach($vouchers as $voucher) {
                Voucher::create ($voucher);
            }
        }
    }