<?php

use yii\db\Migration;

class m171015_214522_create_table_permission extends Migration
{
    public function safeUp()
    {
        $uri = 512;
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            $uri = 150;
        }

        $this->createTable('{{%permission}}', [
            'id' => $this->integer(10)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_permission' => $this->integer(10)->unsigned(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue('1'),
            'logged' => $this->smallInteger(1)->notNull()->defaultValue('1'),
            'show_in_menu' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'name' => $this->string(32)->notNull(),
            'uri' => $this->string($uri)->notNull(),
            'icon' => $this->string(16),
            'data_method' => $this->string()->notNull()->defaultValue('GET'),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('uk_permissions_name_uri_idx', '{{%permission}}', ['name','uri'], true);
        $this->createIndex('uk_permissions_id_permission_name_uri_idx', '{{%permission}}', ['id_permission','name','uri'], true);

        $this->addForeignKey('fk_permissions_permission_idx', '{{%permission}}', 'id_permission', '{{%permission}}', 'id');

        $this->insert('{{%permission}}', [
            'id'=>'1',
            'id_permission'=>'',
            'status'=>'1',
            'show_in_menu'=>'1',
            'name'=>'RBAC',
            'uri'=>'/rbac',
            'icon'=>'',
            'date_modified'=>null, //'2017-10-15 18:09:48',
            'date_created'=>null, //'2017-10-15 18:09:48'
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%permission}}');
    }
}
