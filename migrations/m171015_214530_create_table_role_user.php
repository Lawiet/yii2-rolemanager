<?php

use yii\db\Migration;

class m171015_214530_create_table_role_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%role_user}}', [
            'id' => $this->integer(11)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_role' => $this->integer(11)->unsigned()->notNull(),
            'id_user' => $this->integer(11)->unsigned()->notNull(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('0'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->batchInsert('{{%role_user}}', ['id', 'id_role', 'id_user'], [
            ['1','1','1',],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%role_user}}');
    }
}
