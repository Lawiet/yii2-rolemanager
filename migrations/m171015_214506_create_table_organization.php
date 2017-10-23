<?php

use yii\db\Migration;

class m171015_214506_create_table_organization extends Migration
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
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->insert('{{%organization}}', [
            'id'=>'1',
            'id_group'=>'1',
            'status'=>'1',
            'name'=>'Master',
            'date_modified'=>null, //'2017-10-15 18:07:41',
            'date_created'=>null, //'2017-10-15 18:07:41'
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%organization}}');
    }
}
