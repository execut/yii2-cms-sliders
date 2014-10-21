<?php

use yii\db\Schema;
use yii\db\Migration;

class m141021_075310_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        // Create 'slider' table
        $this->createTable('{{%slider}}', [
            'id'                    => Schema::TYPE_PK,
            'name'                  => Schema::TYPE_STRING . ' NOT NULL',
            'width'                 => Schema::TYPE_INTEGER . '(5) UNSIGNED NOT NULL',
            'height'                => Schema::TYPE_INTEGER . '(5) UNSIGNED NOT NULL',
            'created_at'            => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'updated_at'            => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
        ], $tableOptions);
        
        // Create 'image' table
        $this->createTable('{{%image}}', [
            'id'            => Schema::TYPE_PK,
            'filePath'      => Schema::TYPE_TEXT . ' NOT NULL',
            'name'          => Schema::TYPE_STRING . '(255) NOT NULL',
            'itemId'        => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'isMain'        => 'TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\'',
            'modelName'     => Schema::TYPE_STRING . '(255) NOT NULL',
            'urlAlias'      => Schema::TYPE_TEXT . ' NOT NULL',
            'position'      => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'created_at'    => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
        ], $tableOptions);
        
        $this->createIndex('itemId', '{{%image}}', 'itemId');
        
        // Create 'image_lang' table
        $this->createTable('{{%image_lang}}', [
            'image_id'              => Schema::TYPE_INTEGER . ' NOT NULL',
            'language'              => Schema::TYPE_STRING . '(2) NOT NULL',
            'alt'                   => Schema::TYPE_STRING . '(255) NOT NULL',
            'title'                 => Schema::TYPE_STRING . '(255) NOT NULL',
            'description'           => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at'            => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'updated_at'            => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
        ], $tableOptions);

        $this->addPrimaryKey('image_lang_image_id_language', '{{%image_lang}}', ['image_id', 'language']);
        $this->createIndex('language', '{{%image_lang}}', 'language');
        $this->addForeignKey('FK_IMAGE_LANG_IMAGE_ID', '{{%image_lang}}', 'image_id', '{{%image}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('image_lang');
        $this->dropTable('image');
        $this->dropTable('slider');

        return false;
    }
}
