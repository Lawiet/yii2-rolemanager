<?php

use yii\db\Migration;

class m171015_214532_create_table_permissions extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%permissions}}', [
            'id' => $this->integer(10)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_permission' => $this->integer(10)->unsigned(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue('1'),
            'show_in_menu' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'name' => $this->string(64)->notNull(),
            'uri' => $this->string(760)->notNull(),
            'icon' => $this->string(16),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_permissions_name_uri_idx', '{{%permissions}}', ['name','uri'], true);
        $this->createIndex('uk_permissions_id_permission_name_uri_idx', '{{%permissions}}', ['id_permission','name','uri'], true);

        $this->addForeignKey('fk_permissions_permission_idx', '{{%permissions}}', 'id_permission', '{{%permissions}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%permissions}}');
    }
}
