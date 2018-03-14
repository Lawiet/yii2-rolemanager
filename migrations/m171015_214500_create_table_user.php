<?php

use yii\db\Migration;

class m171015_214500_create_table_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->integer(11)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'status' => $this->string()->notNull()->defaultValue('ACTIVE'),
            'id_organization' => $this->integer(11)->unsigned()->notNull(),
            'email' => $this->string(180),
            'username' => $this->string(64)->notNull(),
            'password' => $this->string(512)->notNull(),
            'last_conection' => $this->timestamp()->defaultExpression('0'),
            'last_activity' => $this->timestamp()->defaultExpression('0'),
            'token_security' => $this->string(512),
            'date_expired_token_security' => $this->integer(11)->defaultValue('600'),
            'token_recovery_password' => $this->string(512),
            'date_token_recovery_password' => $this->timestamp(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('0'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'id'=>'1',
            'status'=>'ACTIVE',
            'id_organization'=>'1',
            'email'=>'admin@noreply.com',
            'username'=>'admin',
            'password'=>'$2y$13$wqU2Gvp67UXifBiFS7PdJeZkFocCg8qJvb.6iw73yZ3fAi9T.2weO',
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
        $this->dropTable('{{%user}}');
    }
}
