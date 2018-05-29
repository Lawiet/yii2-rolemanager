<?php

namespace lawiet\rbac\models;

use Yii;

/**
 * This is the model class for table "role_user".
 *
 * @property string $id
 * @property string $id_role
 * @property string $id_user
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Role $role
 * @property User $user
 */
class RoleUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_role', 'id_user'], 'required'],
            [['id_role', 'id_user'], 'integer'],
            [['date_modified', 'date_created'], 'safe'],
            [['id_role', 'id_user'], 'unique', 'targetAttribute' => ['id_role', 'id_user']],
            [['id_role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['id_role' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_role' => Yii::t('app', 'Id Role'),
            'id_user' => Yii::t('app', 'Id User'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'id_role']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
