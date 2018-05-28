<?php

use yii\db\Migration;

class m171015_214503_create_table_group extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%group}}', [
            'id' => $this->integer(11)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'status' => $this->smallInteger(1)->notNull()->defaultValue('1'),
            'name' => $this->string(64)->notNull(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('0'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->batchInsert('{{%group}}', ['id', 'name',], [
            ['1','Develop',],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%group}}');
    }
}
