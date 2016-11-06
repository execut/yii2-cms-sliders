<?php

use yii\db\Schema;
use yii\db\Migration;

class m141021_075310_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        // Create 'slider' table
        $this->createTable('{{%slider}}', [
            'id'                    => $this->primaryKey(),
            'name'                  => $this->string()->notNull(),
            'width'                 => $this->integer(5)->unsigned()->notNull(),
            'height'                => $this->integer(5)->unsigned()->notNull(),
            'created_at'            => $this->integer()->unsigned()->notNull(),
            'updated_at'            => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('slider');
    }
}
