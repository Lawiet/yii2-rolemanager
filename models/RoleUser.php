<?php

namespace lawiet\rbac\models;

use Yii;

/**
 * This is the model class for table "role_user".
 *
 * @property integer $id
 * @property string $id_rol
 * @property string $id_user
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Role $idRol
 * @property User $idUser
 */
class RoleUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_rol', 'id_user'], 'required'],
            [['id_rol', 'id_user'], 'integer'],
            [['date_modified', 'date_created'], 'safe'],
            [['id_rol', 'id_user'], 'unique', 'targetAttribute' => ['id_rol', 'id_user'], 'message' => 'The combination of Id Rol and Id User has already been taken.'],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['id_rol' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_rol' => Yii::t('app', 'Id Rol'),
            'id_user' => Yii::t('app', 'Id User'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol()
    {
        return $this->hasOne(Role::className(), ['id' => 'id_rol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
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
