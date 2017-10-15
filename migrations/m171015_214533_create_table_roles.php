<?php

use yii\db\Migration;

class m171015_214533_create_table_roles extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%roles}}', [
            'id' => $this->integer(10)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'status' => $this->smallInteger(1)->notNull()->defaultValue('1'),
            'name' => $this->string(64)->notNull(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_roles_unique_name_idx', '{{%roles}}', 'name', true);
    }

    public function safeDown()
    {
        $this->dropTable('{{%roles}}');
    }
}
