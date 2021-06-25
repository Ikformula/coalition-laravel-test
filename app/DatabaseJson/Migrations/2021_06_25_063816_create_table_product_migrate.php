<?php

namespace App\DatabaseJson\Migrations;

use DatabaseJson\DatabaseJson;
use DatabaseJson\Migration;

class CreateTableProductMigrate extends Migration
{
    /**
     * How to create table
     *
     * DatabaseJson::table('NameTable',array(
     *  {field_name} => {field_type} More information about field types and usage in PHPDoc
     * ));
     */

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DatabaseJson::create('products', array(
            'id' => 'integer',
            'name' => 'string',
            'quantity_in_stock' => 'integer',
            'price_per_item' => 'double',
            'created_at' => 'string',
            'updated_at' => 'string',
        ));
    }
}
