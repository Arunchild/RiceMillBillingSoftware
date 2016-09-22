<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingFinalKurunaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billing_final_kurunais', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bill_number');
			$table->integer('total_kg');
			$table->decimal('grand_total', 10, 2);
			$table->decimal('discount', 10, 2);
			$table->decimal('net_amount', 10, 2);
			$table->string('customer_name');
			$table->string('customer_phone');
			$table->string('address');
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
		Schema::drop('billing_final_kurunais');
	}

}
