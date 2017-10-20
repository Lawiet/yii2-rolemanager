<?php

namespace lawiet\rbac\models;

use Yii;

/**
 * This is the model class for table "_audit".
 *
 * @property string $id_user
 * @property string $date_created
 * @property string $table_operation
 * @property string $type_operation
 * @property string $old_change
 *
 * @property User $idUser
 */
class Audit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '_audit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'table_operation', 'type_operation', 'old_change'], 'required'],
            [['id_user'], 'integer'],
            [['date_created'], 'safe'],
            [['old_change'], 'string'],
            [['table_operation', 'type_operation'], 'string', 'max' => 32],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => Yii::t('app', 'Id User'),
            'date_created' => Yii::t('app', 'Date Created'),
            'table_operation' => Yii::t('app', 'Table Operation'),
            'type_operation' => Yii::t('app', 'Type Operation'),
            'old_change' => Yii::t('app', 'Old Change'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
