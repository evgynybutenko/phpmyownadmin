<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sys_table`.
 */
class m200313_152729_create_sys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sys_table', [
            'id' => $this->primaryKey(),
            'table_name' => $this->string(255),
            'title' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sys_table');
    }
}
