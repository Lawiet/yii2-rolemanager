<?php

namespace lawiet\rbac\models;

use Yii;

/**
 * This is the model class for table "permission_role".
 *
 * @property integer $id
 * @property string $id_permission
 * @property string $id_rol
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Permission $idPermission
 * @property Role $idRol
 */
class PermissionRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permission_role';
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
            [['id_permission'], 'exist', 'skipOnError' => true, 'targetClass' => Permission::className(), 'targetAttribute' => ['id_permission' => 'id']],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['id_rol' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_permission' => Yii::t('app', 'Id Permission'),
            'id_rol' => Yii::t('app', 'Id Rol'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'date_created' => Yii::t('app', 'Date Created'),
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
    public function getIdRol()
    {
        return $this->hasOne(Role::className(), ['id' => 'id_rol']);
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
