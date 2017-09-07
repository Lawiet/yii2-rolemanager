<?php

namespace lawiet\rbac\models;

use Yii;

/**
 * @author Jorge Gonzalez
 * @email ljorgelgonzalez@outlook.com
 *
 * @since 1.0
 */

/**
 * This is the model class for table "roles".
 *
 * @property integer $id
 * @property boolean $status
 * @property string $name
 * @property string $date_modified
 * @property string $date_created
 *
 * @property GroupsRoles[] $groupsRoles
 * @property Groups[] $idGroups
 * @property PermissionsRoles[] $permissionsRoles
 * @property Permissions[] $idPermissions
 * @property RolesUsers[] $rolesUsers
 * @property Users[] $idUsers
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'boolean'],
            [['name'], 'required'],
            [['date_modified', 'date_created'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'name' => 'Name',
            'date_modified' => 'Date Modified',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupsRoles()
    {
        return $this->hasMany(GroupsRoles::className(), ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGroups()
    {
        return $this->hasMany(Groups::className(), ['id' => 'id_group'])->viaTable('groups_roles', ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissionsRoles()
    {
        return $this->hasMany(PermissionsRoles::className(), ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPermissions()
    {
        return $this->hasMany(Permissions::className(), ['id' => 'id_permission'])->viaTable('permissions_roles', ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolesUsers()
    {
        return $this->hasMany(RolesUsers::className(), ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'id_user'])->viaTable('roles_users', ['id_rol' => 'id']);
    }
}
