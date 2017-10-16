<?php

use yii\db\Migration;

class m171015_214523_create_table_group extends Migration
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
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_groups_name_idx', '{{%group}}', 'name', true);

        $this->insert('{{%group}}', [
            'id'=>'1',
            'status'=>'1',
            'name'=>'Develop',
            'date_modified'=>null, //'2017-10-15 18:08:55',
            'date_created'=>null, //'2017-10-15 18:08:55'
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%group}}');
    }
}
