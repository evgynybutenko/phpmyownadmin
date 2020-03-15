<?php

use yii\db\Migration;

/**
 * Handles the creation of table `item_url`.
 */
class m200315_113401_create_item_url_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('item_url', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255),
            'item_name' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('item_url');
    }
}
