<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingOthersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billing_others', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bill_number');
			$table->integer('product_code');
			$table->string('product_name');
			$table->integer('kg');
			$table->decimal('selling_price', 20, 2);
			$table->integer('quantity');
			$table->decimal('total', 20, 2);
			$table->date('sale_date');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('billing_others');
	}

}
