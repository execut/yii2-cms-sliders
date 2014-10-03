<?php

use yii\db\Schema;
use yii\db\Migration;

class m141003_113622_update_image_table extends Migration
{
    public function up()
    {
        $this->addColumn('image', 'position', Schema::TYPE_INTEGER . '(10) UNSIGNED NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('image', 'position');
    }
}
