<?php

use yii\db\Migration;

class m171015_214500_create_table_organization extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%organization}}', [
            'id' => $this->integer(11)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_group' => $this->integer(11)->unsigned(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue('1'),
            'name' => $this->string(128)->notNull(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('0'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->batchInsert('{{%organization}}', ['id', 'id_group', 'name'], [
            ['1','1','Master',],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%organization}}');
    }
}
