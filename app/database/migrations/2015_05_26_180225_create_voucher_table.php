<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vouchers', function($table) {
			$table->increments('id');
			$table->string('code');
			$table->boolean('is_active')->default(true);
			$table->float('min_basket');
			$table->float('discount_amount');
			$table->char('discount_type');
			$table->string('special_condition')->default('');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vouchers');
	}

}
