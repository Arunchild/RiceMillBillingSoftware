<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseFinalKurunaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_final_kurunais', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('purchase_number');
			$table->decimal('grand_total', 10, 2);
			$table->decimal('discount', 10, 2);
			$table->decimal('net_amount', 10, 2);
			$table->string('customer_name');
			$table->string('customer_phone');
			$table->string('address');
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
		Schema::drop('purchase_final_kurunais');
	}

}
