<?php

use yii\db\Migration;

class m171015_214500_create_table__audit extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%_audit}}', [
            'id_user' => $this->integer(11)->unsigned()->notNull(),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'table_operation' => $this->string(32)->notNull(),
            'type_operation' => $this->string(32)->notNull(),
            'old_change' => $this->text()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%_audit}}');
    }
}
