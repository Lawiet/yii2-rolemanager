<?php

use yii\db\Migration;

class m171015_214534_create_table_assignments_users extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%assignments_users}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_assignment' => $this->integer(10)->unsigned()->notNull(),
            'id_user' => $this->integer(10)->unsigned()->notNull(),
            'toggle' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_permissions_users_id_assignment_id_user_idx', '{{%assignments_users}}', ['id_assignment','id_user'], true);

        $this->addForeignKey('fk_assignments_users_assignment_idx', '{{%assignments_users}}', 'id_assignment', '{{%assignments}}', 'id');
        $this->addForeignKey('fk_assignments_users_user_idx', '{{%assignments_users}}', 'id_user', '{{%users}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%assignments_users}}');
    }
}
