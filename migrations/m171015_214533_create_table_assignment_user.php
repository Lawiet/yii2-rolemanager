<?php

use yii\db\Migration;

class m171015_214533_create_table_assignment_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%assignment_user}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_assignment' => $this->integer(10)->unsigned()->notNull(),
            'id_user' => $this->integer(10)->unsigned()->notNull(),
            'toggle' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_permissions_users_id_assignment_id_user_idx', '{{%assignment_user}}', ['id_assignment','id_user'], true);

        $this->addForeignKey('fk_assignments_users_assignment_idx', '{{%assignment_user}}', 'id_assignment', '{{%assignment}}', 'id');
        $this->addForeignKey('fk_assignments_users_user_idx', '{{%assignment_user}}', 'id_user', '{{%user}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%assignment_user}}');
    }
}
