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
            'id_status' => $this->integer(11)->unsigned()->notNull(),
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

        $this->batchInsert('{{%user}}', ['id', 'id_status', 'id_organization', 'email', 'username', 'password', 'last_conection', 'last_activity', 'token_security', 'date_expired_token_security', 'token_recovery_password', 'date_token_recovery_password'], [
            ['1','1','1','admin@noreply.com','admin','$2y$13$wqU2Gvp67UXifBiFS7PdJeZkFocCg8qJvb.6iw73yZ3fAi9T.2weO',null,null,null,null,null,null,],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
