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
            'id_assignment' => $this->integer(11)->unsigned()->notNull(),
            'id_user' => $this->integer(11)->unsigned()->notNull(),
            'toggle' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_permissions_users_id_assignment_id_user_idx', '{{%assignment_user}}', ['id_assignment','id_user'], true);

        $this->addForeignKey('fk_assignments_users_assignment_idx', '{{%assignment_user}}', 'id_assignment', '{{%assignment}}', 'id');
        $this->addForeignKey('fk_assignments_users_user_idx', '{{%assignment_user}}', 'id_user', '{{%user}}', 'id');

        $this->batchInsert('{{%assignment_user}}', ['id_assignment', 'id_user',], [
            ['1','1',],
            ['2','1',],
            ['3','1',],
            ['4','1',],
            ['5','1',],
            ['6','1',],
            ['7','1',],
            ['8','1',],
            ['9','1',],
            ['10','1',],
            ['11','1',],
            ['12','1',],
            ['13','1',],
            ['14','1',],
            ['15','1',],
            ['16','1',],
            ['17','1',],
            ['18','1',],
            ['19','1',],
            ['20','1',],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%assignment_user}}');
    }
}
