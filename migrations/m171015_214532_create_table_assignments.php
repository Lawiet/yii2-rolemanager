<?php

use yii\db\Migration;

class m171015_214532_create_table_assignments extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%assignments}}', [
            'id' => $this->integer(11)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_permission' => $this->integer(11)->unsigned()->notNull(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue('1'),
            'show_in_menu' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'name' => $this->string(64)->notNull(),
            'method' => $this->string()->notNull()->defaultValue('INDEX'),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_assignments_id_permission_method_idx', '{{%assignments}}', ['id_permission','method'], true);

        $this->addForeignKey('fk_assignments_permission_idx', '{{%assignments}}', 'id_permission', '{{%permissions}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%assignments}}');
    }
}
