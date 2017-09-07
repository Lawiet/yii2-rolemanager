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
 * This is the model class for table "permissions_roles".
 *
 * @property integer $id
 * @property integer $id_permission
 * @property integer $id_rol
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Permissions $idPermission
 * @property Roles $idRol
 */
class PermissionsRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permissions_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_permission', 'id_rol'], 'required'],
            [['id_permission', 'id_rol'], 'integer'],
            [['date_modified', 'date_created'], 'safe'],
            [['id_permission', 'id_rol'], 'unique', 'targetAttribute' => ['id_permission', 'id_rol'], 'message' => 'The combination of Id Permission and Id Rol has already been taken.'],
            [['id_permission'], 'exist', 'skipOnError' => true, 'targetClass' => Permissions::className(), 'targetAttribute' => ['id_permission' => 'id']],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['id_rol' => 'id']],
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
            'id_rol' => 'Id Rol',
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
    public function getIdRol()
    {
        return $this->hasOne(Roles::className(), ['id' => 'id_rol']);
    }
}
