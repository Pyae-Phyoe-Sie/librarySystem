<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m200720_072354_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id'            => $this->primaryKey(),
            'book_name'     => $this->string(255)->notnull(),
            'author'        => $this->string(255)->notnull(),
            'price'         => $this->double()->notnull(),
            'qty'           => $this->integer(10)->notnull(),
            'delete_flag'   => $this->boolean()->notnull(),
            'created_by'    => $this->integer(11)->notnull(),
            'updated_by'    => $this->integer(11),
            'created_at'    => $this->timestamp()->defaultExpression('NOW()'),
            'updated_at'    => $this->timestamp()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%books}}');
    }
}
