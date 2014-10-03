<?php

use yii\db\Schema;
use yii\db\Migration;

class m141003_081011_init extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Create 'slider' table
        $this->createTable('{{%slider}}', [
            'id'                    => Schema::TYPE_PK . '(10)',
            'name'                  => Schema::TYPE_STRING . ' NOT NULL',
            'width'                 => Schema::TYPE_INTEGER . '(5) UNSIGNED NOT NULL',
            'height'                => Schema::TYPE_INTEGER . '(5) UNSIGNED NOT NULL',
            'created_at'            => Schema::TYPE_INTEGER . '(10) UNSIGNED NOT NULL',
            'updated_at'            => Schema::TYPE_INTEGER . '(10) UNSIGNED NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('slider');
    }
}