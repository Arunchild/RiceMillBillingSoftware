<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('tin');
			$table->string('cst');
			$table->string('companyname');
			$table->string('billingname');
			$table->string('phone');
			$table->string('addressline1');
			$table->string('addressline2');
			$table->string('terms_and_conditions');
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
		Schema::drop('company_details');
	}

}
