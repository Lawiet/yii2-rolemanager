<?php

namespace lawiet\rbac\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property string $id
 * @property integer $status
 * @property string $name
 * @property string $date_modified
 * @property string $date_created
 *
 * @property GroupRole[] $groupRoles
 * @property Group[] $idGroups
 * @property PermissionRole[] $permissionRoles
 * @property Permission[] $idPermissions
 * @property RoleUser[] $roleUsers
 * @property User[] $idUsers
 */
class Role extends \yii\db\ActiveRecord
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
            [['status'], 'integer'],
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
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'Name'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupRoles()
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
    public function getPermissionRoles()
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
    public function getRoleUsers()
    {
        return $this->hasMany(RoleUser::className(), ['id_rol' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'id_user'])->viaTable('role_user', ['id_rol' => 'id']);
    }

    /**
     * @inheritdoc
     */
	public function beforeSave($insert)
	{
	    // hash password on before saving the record:
        $this->date_modified = new \yii\db\Expression('NOW()');
		return parent::beforeSave($insert);
	}
}
