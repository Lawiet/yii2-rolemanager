<?php

namespace lawiet\rbac\models;

use Yii;

/**
 * This is the model class for table "permission_role".
 *
 * @property string $id
 * @property string $id_permission
 * @property string $id_role
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Permission $permission
 * @property Role $rol
 */
class PermissionRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permission_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_permission', 'id_role'], 'required'],
            [['id_permission', 'id_role'], 'integer'],
            [['date_modified', 'date_created'], 'safe'],
            [['id_permission', 'id_role'], 'unique', 'targetAttribute' => ['id_permission', 'id_role']],
            [['id_permission'], 'exist', 'skipOnError' => true, 'targetClass' => Permission::className(), 'targetAttribute' => ['id_permission' => 'id']],
            [['id_role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['id_role' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_permission' => Yii::t('app', 'Id Permission'),
            'id_role' => Yii::t('app', 'Id Rol'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermission()
    {
        return $this->hasOne(Permission::className(), ['id' => 'id_permission']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Role::className(), ['id' => 'id_role']);
    }
}
