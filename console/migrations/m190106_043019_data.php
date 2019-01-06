<?php

class m190106_043019_data extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%user}}', [], [
            [
                'id' => 1,
                'username' => 'user',
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
                'password_reset_token' => NULL,
                'email' => 'user@example.com',
                'status' => 10,
                'created_at' => strtotime('today 10:00'),
                'updated_at' => strtotime('today 10:00'),
            ],
        ]);

        $this->batchInsert('{{%currency}}', [], [
            ['id' => 1, 'name' => 'RUB'],
            ['id' => 2, 'name' => 'USD'],
        ]);

        $this->batchInsert('{{%order}}', [], [
            [
                'id' => 1,
                'user_id' => 1,
                'currency_id' => 1,
                'amount' => '10.00',
                'message' => 'Test order 1',
                'created_at' => strtotime('today 11:00'),
                'updated_at' => strtotime('today 11:00'),
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'currency_id' => 2,
                'amount' => '100.00',
                'message' => 'Test order 2',
                'created_at' => strtotime('today 12:00'),
                'updated_at' => strtotime('today 12:00'),
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'currency_id' => 1,
                'amount' => '1000.00',
                'message' => 'Test order 3',
                'created_at' => strtotime('today 13:00'),
                'updated_at' => strtotime('today 13:00'),
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'currency_id' => 2,
                'amount' => '1000.00',
                'message' => 'Test order 4',
                'created_at' => strtotime('today 14:00'),
                'updated_at' => strtotime('today 14:00'),
            ],
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%order}}');
        $this->delete('{{%currency}}');
        $this->delete('{{%user}}');
    }
}
