<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMasterOthersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_master_others', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('product_name');
			$table->integer('kg');
			$table->decimal('selling_price', 20, 2);
			$table->integer('in_stock');
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
		Schema::drop('product_master_others');
	}

}
