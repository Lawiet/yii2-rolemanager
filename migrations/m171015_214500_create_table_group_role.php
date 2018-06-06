<?php

use yii\db\Migration;

class m171015_214500_create_table_group_role extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%group_role}}', [
            'id' => $this->integer(11)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_group' => $this->integer(11)->unsigned()->notNull(),
            'id_role' => $this->integer(11)->unsigned()->notNull(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('0'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->insert('{{%group_role}}', [
            'id'=>'1',
            'id_group'=>'1',
            'id_role'=>'1',
            'date_modified'=>null, //'2017-10-15 18:09:06',
            'date_created'=>null, //'2017-10-15 18:09:06'
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%group_role}}');
    }
}
