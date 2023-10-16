<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


//DB Schema


class CreateCompaniesTable extends Migration
{
    public function up():void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->unique();
            $table->string('logo')->nullable();
            $table->string('name')->unique();
            $table->char('city', 40);
            $table->char('country', 40);
            $table->string('webmail')->nullable();
            $table->string('email')->unique();
            $table->integer('employees');
            $table->string('funding_state');
            $table->string('industry');
            $table->string('technology');
            $table->string('trl');
            $table->string('business_model');
            $table->string('revenue_model');
            $table->string('funding_sources');
            $table->string('total_funding');
            $table->text('executive_summary');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
