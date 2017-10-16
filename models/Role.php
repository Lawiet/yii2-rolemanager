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
 * @property GroupRole[] $groupsRoles
 * @property Group[] $idGroups
 * @property PermissionRole[] $permissionsRoles
 * @property Permission[] $idPermissions
 * @property RoleUser[] $rolesUsers
 * @property User[] $idUsers
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
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
            'id' => \Yii::t('app', 'ID'),
            'status' => \Yii::t('app', 'Status'),
            'name' => \Yii::t('app', 'Name'),
            'date_modified' => \Yii::t('app', 'Date Modified'),
            'date_created' => \Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupsRoles()
    {
        return $this->hasMany(GroupRole::className(), ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGroups()
    {
        return $this->hasMany(Group::className(), ['id' => 'id_group'])->viaTable('group_role', ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissionsRoles()
    {
        return $this->hasMany(PermissionRole::className(), ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPermissions()
    {
        return $this->hasMany(Permission::className(), ['id' => 'id_permission'])->viaTable('permission_role', ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolesUsers()
    {
        return $this->hasMany(RolesUser::className(), ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'id_user'])->viaTable('role_user', ['id_rol' => 'id']);
    }
}
