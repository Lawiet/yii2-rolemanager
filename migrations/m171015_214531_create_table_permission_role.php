<?php

use yii\db\Migration;

class m171015_214531_create_table_permission_role extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%permission_role}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_permission' => $this->integer(11)->unsigned()->notNull(),
            'id_rol' => $this->integer(11)->unsigned()->notNull(),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('0'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_permissions_roles_id_permission_id_rol_idx', '{{%permission_role}}', ['id_permission','id_rol'], true);

        $this->addForeignKey('fk_permissions_roles_permission_idx', '{{%permission_role}}', 'id_permission', '{{%permission}}', 'id');
        $this->addForeignKey('fk_permissions_roles_rol_idx', '{{%permission_role}}', 'id_rol', '{{%role}}', 'id');

        $this->batchInsert('{{%permission_role}}', ['id_permission', 'id_rol',], [
            ['1','1',],
            ['2','1',],
            ['3','1',],
            ['4','1',],
            ['5','1',],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%permission_role}}');
    }
}
