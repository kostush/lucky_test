<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Link;

class CreateLinksTable extends Migration
{

    private $model;
    public function __construct()
    {
        $this->model = new Link();
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->integer("client_id");
            $table->string("short")->unique();
            $table->text("full");
            $table->string("client_hash");
            $table->dateTime("expiration");
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
        Schema::dropIfExists('links');
    }
}
