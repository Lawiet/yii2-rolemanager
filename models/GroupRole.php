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
 * This is the model class for table "groups_roles".
 *
 * @property integer $id
 * @property integer $id_group
 * @property integer $id_rol
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Group $idGroup
 * @property Role $idRol
 */
class GroupRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_group', 'id_rol'], 'required'],
            [['id_group', 'id_rol'], 'integer'],
            [['date_modified', 'date_created'], 'safe'],
            [['id_rol', 'id_group'], 'unique', 'targetAttribute' => ['id_rol', 'id_group'], 'message' => 'The combination of Id Group and Id Rol has already been taken.'],
            [['id_group'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['id_group' => 'id']],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['id_rol' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'id_group' => \Yii::t('app', 'Id Group'),
            'id_rol' => \Yii::t('app', 'Id Rol'),
            'date_modified' => \Yii::t('app', 'Date Modified'),
            'date_created' => \Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'id_group']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol()
    {
        return $this->hasOne(Role::className(), ['id' => 'id_rol']);
    }
}