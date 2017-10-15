<?php

use yii\db\Migration;

class m171015_214533_create_table_roles_users extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%roles_users}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_rol' => $this->integer(11)->unsigned()->notNull(),
            'id_user' => $this->integer(11)->unsigned()->notNull(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_roles_users_id_rol_id_user_idx', '{{%roles_users}}', ['id_rol','id_user'], true);

        $this->addForeignKey('fk_roles_users_rol_idx', '{{%roles_users}}', 'id_rol', '{{%roles}}', 'id');
        $this->addForeignKey('fk_roles_users_user_idx', '{{%roles_users}}', 'id_user', '{{%users}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%roles_users}}');
    }
}
