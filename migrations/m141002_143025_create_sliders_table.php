<?php

use yii\db\Schema;
use yii\db\Migration;

class m141002_143025_create_sliders_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Create 'slider' table
        $this->createTable('{{%page_partials}}', [
            'id'                    => Schema::TYPE_PK,
            'name'                  => Schema::TYPE_STRING . '(255) NOT NULL',
            'width'                 => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'height'                => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'created_at'            => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'updated_at'            => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
        ], $tableOptions);

        $this->addPrimaryKey('id', '{{%slider}}', ['id']);
    }

    public function down()
    {
        $this->dropTable('slider');
    }
}
