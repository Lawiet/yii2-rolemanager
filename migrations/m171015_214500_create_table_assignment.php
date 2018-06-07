<?php

use yii\db\Migration;

class m171015_214500_create_table_assignment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%assignment}}', [
            'id' => $this->integer(11)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'id_permission' => $this->integer(11)->unsigned()->notNull(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue('1'),
            'show_in_menu' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'name' => $this->string(64)->notNull(),
            'method' => $this->string()->notNull()->defaultValue('INDEX'),
            'date_modified' => $this->timestamp()->notNull()->defaultExpression('0'),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->batchInsert('{{%assignment}}', ['id', 'id_permission', 'name', 'method'], [
            // Role
            ['1','2','Ver','VIEW',],
            ['2','2','Listar','INDEX',],
            ['3','2','Crear','CREATE',],
            ['4','2','Actualizar','UPDATE',],
            ['5','2','Eliminar','DELETE',],
            // Permission
            ['6','3','Ver','VIEW',],
            ['7','3','Listar','INDEX',],
            ['8','3','Crear','CREATE',],
            ['9','3','Actualizar','UPDATE',],
            ['10','3','Eliminar','DELETE',],
            // Group
            ['11','4','Ver','VIEW',],
            ['12','4','Listar','INDEX',],
            ['13','4','Crear','CREATE',],
            ['14','4','Actualizar','UPDATE',],
            ['15','4','Eliminar','DELETE',],
            // Assignment
            ['16','5','Ver','VIEW',],
            ['17','5','Listar','INDEX',],
            ['18','5','Crear','CREATE',],
            ['19','5','Actualizar','UPDATE',],
            ['20','5','Eliminar','DELETE',],
            // Organization
            ['21','6','Ver','VIEW',],
            ['22','6','Listar','INDEX',],
            ['23','6','Crear','CREATE',],
            ['24','6','Actualizar','UPDATE',],
            ['25','6','Eliminar','DELETE',],
            // User
            ['26','7','Ver','VIEW',],
            ['27','7','Listar','INDEX',],
            ['28','7','Crear','CREATE',],
            ['29','7','Actualizar','UPDATE',],
            ['30','7','Eliminar','DELETE',],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%assignment}}');
    }
}
