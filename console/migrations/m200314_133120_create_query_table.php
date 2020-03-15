<?php

use yii\db\Migration;

/**
 * Handles the creation of table `query`.
 */
class m200314_133120_create_query_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('query', [
            'id' => $this->primaryKey(),
            'sql_script' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('query');
    }
}
