<?php

use yii\db\Migration;

class m171015_214599_create_index extends Migration
{
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		/* ***************** INDEX's ****************** */

		// assignment
        $this->createIndex('uk_assignments_id_permission_method_idx', '{{%assignment}}', ['id_permission','method'], true);
		
		// assignment_user
        $this->createIndex('uk_permissions_users_id_assignment_id_user_idx', '{{%assignment_user}}', ['id_assignment','id_user'], true);

		// group
        $this->createIndex('uk_groups_name_idx', '{{%group}}', 'name', true);

		// group_role
        $this->createIndex('uk_groups_roles_id_rol_id_group_idx', '{{%group_role}}', ['id_group','id_rol'], true);

		// organization
        $this->createIndex('uk_organization_unique_name_idx', '{{%organization}}', ['id_group','name'], true);

		// permission
        $this->createIndex('uk_permissions_name_uri_idx', '{{%permission}}', ['name','uri'], true);
        $this->createIndex('uk_permissions_id_permission_name_uri_idx', '{{%permission}}', ['id_permission','name','uri'], true);
		
		// permission_role
        $this->createIndex('uk_permissions_roles_id_permission_id_rol_idx', '{{%permission_role}}', ['id_permission','id_rol'], true);

		// role
        $this->createIndex('uk_roles_unique_name_idx', '{{%role}}', 'name', true);

		// role_user
        $this->createIndex('uk_roles_users_id_rol_id_user_idx', '{{%role_user}}', ['id_role','id_user'], true);

		// user
        $this->createIndex('uk_users_username_idx', '{{%user}}', 'username', true);
        $this->createIndex('uk_users_email_idx', '{{%user}}', 'email', true);
        $this->createIndex('uk_users_username_email_idx', '{{%user}}', ['email','username'], true);
		
		// user_status
        $this->createIndex('uk_users_status_name_uri_idx', '{{%user_status}}', 'name', true);

		
		/* ***************** FOREIGN KEY's ****************** */
		
		// _audit
        $this->addForeignKey('fk_user_id', '{{%_audit}}', 'id_user', '{{%user}}', 'id');

		// assignment
        $this->addForeignKey('fk_assignments_permission_idx', '{{%assignment}}', 'id_permission', '{{%permission}}', 'id');
		
		// assignment_user
        $this->addForeignKey('fk_assignments_users_assignment_idx', '{{%assignment_user}}', 'id_assignment', '{{%assignment}}', 'id');
        $this->addForeignKey('fk_assignments_users_user_idx', '{{%assignment_user}}', 'id_user', '{{%user}}', 'id');

		// group_role
        $this->addForeignKey('fk_groups_roles_group_idx', '{{%group_role}}', 'id_group', '{{%group}}', 'id');
        $this->addForeignKey('fk_groups_roles_rol_idx', '{{%group_role}}', 'id_rol', '{{%role}}', 'id');

		// organization
        $this->addForeignKey('fk_organization_group_idx', '{{%organization}}', 'id_group', '{{%group}}', 'id');
		
		// permission
        $this->addForeignKey('fk_permissions_permission_idx', '{{%permission}}', 'id_permission', '{{%permission}}', 'id');
		
		// permission_role
        $this->addForeignKey('fk_permissions_roles_permission_idx', '{{%permission_role}}', 'id_permission', '{{%permission}}', 'id');
        $this->addForeignKey('fk_permissions_roles_rol_idx', '{{%permission_role}}', 'id_rol', '{{%role}}', 'id');
		
		// role_user
        $this->addForeignKey('fk_roles_users_rol_idx', '{{%role_user}}', 'id_role', '{{%role}}', 'id');
        $this->addForeignKey('fk_roles_users_user_idx', '{{%role_user}}', 'id_user', '{{%user}}', 'id');
		
		// user
        $this->addForeignKey('fk_users_user_status_idx', '{{%user}}', 'id_status', '{{%user_status}}', 'id');
        $this->addForeignKey('fk_users_organization_idx', '{{%user}}', 'id_organization', '{{%organization}}', 'id');
    }

    public function safeDown()
    {
		// nothing
    }
}
