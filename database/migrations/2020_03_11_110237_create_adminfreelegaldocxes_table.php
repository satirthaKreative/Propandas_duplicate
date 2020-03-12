<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminfreelegaldocxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminfreelegaldocxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cate_id');
            $table->enum('is_upload',array('0','1'))->default('0');
            $table->longText('uploaded_path');
            $table->longText('uploaded_text');
            $table->text('uploaded_type');
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
        Schema::dropIfExists('adminfreelegaldocxes');
    }
}
