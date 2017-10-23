<?php

use yii\db\Migration;

class m171015_214520_create_table_user extends Migration
{
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

		// user
        $this->createIndex('uk_users_username_idx', '{{%user}}', 'username', true);
        $this->createIndex('uk_users_email_idx', '{{%user}}', 'email', true);
        $this->createIndex('uk_users_username_email_idx', '{{%user}}', ['email','username'], true);

		// role
        $this->createIndex('uk_roles_unique_name_idx', '{{%role}}', 'name', true);

		//permission
        $this->createIndex('uk_permissions_name_uri_idx', '{{%permission}}', ['name','uri'], true);
        $this->createIndex('uk_permissions_id_permission_name_uri_idx', '{{%permission}}', ['id_permission','name','uri'], true);
        $this->addForeignKey('fk_permissions_permission_idx', '{{%permission}}', 'id_permission', '{{%permission}}', 'id');

		// group
        $this->createIndex('uk_groups_name_idx', '{{%group}}', 'name', true);

		//assignment
        $this->createIndex('uk_assignments_id_permission_method_idx', '{{%assignment}}', ['id_permission','method'], true);
        $this->addForeignKey('fk_assignments_permission_idx', '{{%assignment}}', 'id_permission', '{{%permission}}', 'id');

		// organization
        $this->addForeignKey('fk_group_id', '{{%organization}}', 'id_group', '{{%group}}', 'id');
		
		// _audit
        $this->addForeignKey('fk_user_id', '{{%_audit}}', 'id_user', '{{%user}}', 'id');
    }

    public function safeDown()
    {
		// nothing
    }
}
