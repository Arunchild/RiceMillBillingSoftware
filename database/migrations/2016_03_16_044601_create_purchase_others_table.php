<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOthersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_others', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->integer('purchase_number');
			$table->integer('product_code');
			$table->string('product_name');
			$table->decimal('selling_price', 20, 2);
			$table->integer('quantity');
			$table->decimal('total', 20, 2);
			$table->date('sale_date');
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
		Schema::drop('purchase_others');
	}

}
