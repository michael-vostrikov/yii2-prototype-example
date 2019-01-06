<?php

class m190106_043018_create_tables extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(100)->notNull(),
        ]);


        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'currency_id' => $this->integer()->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'message' => $this->string(1000)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('created_at', '{{%order}}', 'created_at', false);


        $this->addForeignKey('order-user', '{{%order}}', 'user_id', '{{%user}}', 'id', null, null);
        $this->addForeignKey('order-currency', '{{%order}}', 'currency_id', '{{%currency}}', 'id', null, null);
    }

    public function down()
    {
        $this->dropForeignKey('order-currency', '{{%order}}');
        $this->dropForeignKey('order-user', '{{%order}}');

        $this->dropTable('{{%order}}');
        $this->dropTable('{{%currency}}');
    }
}
