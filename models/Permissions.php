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
 * @property Permissions $idPermission
 * @property Permissions[] $permissions
 * @property PermissionsRoles[] $permissionsRoles
 * @property Roles[] $idRols
 */
class Permissions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permissions';
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
            [['id_permission'], 'exist', 'skipOnError' => true, 'targetClass' => Permissions::className(), 'targetAttribute' => ['id_permission' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_permission' => 'Id Permission',
            'status' => 'Status',
            'show_in_menu' => 'Show In Menu',
            'name' => 'Name',
            'uri' => 'Uri',
            'icon' => 'Icon',
            'date_modified' => 'Date Modified',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPermission()
    {
        return $this->hasOne(Permissions::className(), ['id' => 'id_permission']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(Permissions::className(), ['id_permission' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissionsRoles()
    {
        return $this->hasMany(PermissionsRoles::className(), ['id_permission' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRols()
    {
        return $this->hasMany(Roles::className(), ['id' => 'id_rol'])->viaTable('permissions_roles', ['id_permission' => 'id']);
    }
}
