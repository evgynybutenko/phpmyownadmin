<?php

use yii\db\Migration;

/**
 * Class m200310_082233_create_table_category_item
 */
class m200310_082233_create_table_category_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_item', [
            'id' => $this->primaryKey(),
            'item_name' => $this->string(255),
            'id_category' => $this->integer(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category_item');
    }
}
