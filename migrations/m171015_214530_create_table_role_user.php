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
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_rol' => $this->integer(11)->unsigned()->notNull(),
            'id_user' => $this->integer(11)->unsigned()->notNull(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('0'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_roles_users_id_rol_id_user_idx', '{{%role_user}}', ['id_rol','id_user'], true);

        $this->addForeignKey('fk_roles_users_rol_idx', '{{%role_user}}', 'id_rol', '{{%role}}', 'id');
        $this->addForeignKey('fk_roles_users_user_idx', '{{%role_user}}', 'id_user', '{{%user}}', 'id');

        $this->insert('{{%role_user}}', [
            'id'=>'1',
            'id_rol'=>'1',
            'id_user'=>'1',
            'date_modified'=>null, //'2017-10-15 18:08:33',
            'date_created'=>null, //'2017-10-15 18:08:33'
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%role_user}}');
    }
}
