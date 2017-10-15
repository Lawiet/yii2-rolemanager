<?php

use yii\db\Migration;

class m171015_214532_create_table_groups_roles extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%groups_roles}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_group' => $this->integer(10)->unsigned()->notNull(),
            'id_rol' => $this->integer(10)->unsigned()->notNull(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_groups_roles_id_rol_id_group_idx', '{{%groups_roles}}', ['id_group','id_rol'], true);

        $this->addForeignKey('fk_groups_roles_group_idx', '{{%groups_roles}}', 'id_group', '{{%groups}}', 'id');
        $this->addForeignKey('fk_groups_roles_rol_idx', '{{%groups_roles}}', 'id_rol', '{{%roles}}', 'id');

        $this->insert('{{%groups_roles}}', [
            'id'=>'1',
            'id_group'=>'1',
            'id_rol'=>'1',
            'date_modified'=>null, //'2017-10-15 18:09:06',
            'date_created'=>null, //'2017-10-15 18:09:06'
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%groups_roles}}');
    }
}
