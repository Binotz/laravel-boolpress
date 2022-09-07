<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //creo la colonna per la foreign key
            $table->unsignedBigInteger('category_id')->nullable()->after('content');

            //creo la relazione tra tabel
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //rimuovo la relazione tra tabelle
            $table->dropForeign('posts_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}
