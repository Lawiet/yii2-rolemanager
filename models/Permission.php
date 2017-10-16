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
 * This is the model class for table "permissions".
 *
 * @property integer $id
 * @property integer $id_permission
 * @property boolean $status
 * @property integer $show_in_menu
 * @property string $name
 * @property string $uri
 * @property string $icon
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Permission $idPermission
 * @property Permission[] $permissions
 * @property PermissionRole[] $permissionsRoles
 * @property Role[] $idRols
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_permission', 'show_in_menu'], 'integer'],
            [['status'], 'boolean'],
            [['name', 'uri'], 'required'],
            [['date_modified', 'date_created'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['uri'], 'string', 'max' => 760],
            [['icon'], 'string', 'max' => 16],
            [['id_permission', 'name', 'uri'], 'unique', 'targetAttribute' => ['id_permission', 'name', 'uri'], 'message' => 'The combination of Id Permission, Name and Uri has already been taken.'],
            [['name', 'uri'], 'unique', 'targetAttribute' => ['name', 'uri'], 'message' => 'The combination of Name and Uri has already been taken.'],
            [['id_permission'], 'exist', 'skipOnError' => true, 'targetClass' => Permission::className(), 'targetAttribute' => ['id_permission' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'id_permission' => \Yii::t('app', 'Id Permission'),
            'status' => \Yii::t('app', 'Status'),
            'show_in_menu' => \Yii::t('app', 'Show In Menu'),
            'name' => \Yii::t('app', 'Name'),
            'uri' => \Yii::t('app', 'Uri'),
            'icon' => \Yii::t('app', 'Icon'),
            'date_modified' => \Yii::t('app', 'Date Modified'),
            'date_created' => \Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPermission()
    {
        return $this->hasOne(Permission::className(), ['id' => 'id_permission']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(Permission::className(), ['id_permission' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissionsRoles()
    {
        return $this->hasMany(PermissionRole::className(), ['id_permission' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRols()
    {
        return $this->hasMany(Role::className(), ['id' => 'id_rol'])->viaTable('permission_role', ['id_permission' => 'id']);
    }
}
