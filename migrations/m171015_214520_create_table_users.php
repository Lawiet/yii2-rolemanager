<?php

use yii\db\Migration;

class m171015_214520_create_table_users extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%users}}', [
            'id' => $this->integer(10)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'status' => $this->string()->notNull()->defaultValue('ACTIVE'),
            'email' => $this->string(180),
            'username' => $this->string(64)->notNull(),
            'password' => $this->string(512)->notNull(),
            'last_conection' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'last_activity' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'token_security' => $this->string(512),
            'date_expired_token_security' => $this->integer(11)->defaultValue('600'),
            'token_recovery_password' => $this->string(512),
            'date_token_recovery_password' => $this->timestamp(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_users_username_idx', '{{%users}}', 'username', true);
        $this->createIndex('uk_users_email_idx', '{{%users}}', 'email', true);
        $this->createIndex('uk_users_username_email_idx', '{{%users}}', ['email','username'], true);

        $this->insert('{{%users}}', [
            'id'=>'1',
            'status'=>'ACTIVE',
            'email'=>'admin@noreply.com',
            'username'=>'admin',
            'password'=>'123',
            'last_conection'=>null, //'2017-10-15 18:07:41',
            'last_activity'=>null, //'2017-10-15 18:07:41',
            'token_security'=>null, //'',
            'date_expired_token_security'=>null, //'600',
            'token_recovery_password'=>null, //'',
            'date_token_recovery_password'=>null, //'',
            'date_modified'=>null, //'2017-10-15 18:07:41',
            'date_created'=>null, //'2017-10-15 18:07:41'
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
