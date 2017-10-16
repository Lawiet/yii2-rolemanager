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
 * This is the model class for table "assignments_users".
 *
 * @property integer $id
 * @property integer $id_assignment
 * @property integer $id_user
 * @property boolean $toggle
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Assignment $idAssignment
 * @property User $idUser
 */
class AssignmentUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assignment_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_assignment', 'id_user'], 'required'],
            [['id_assignment', 'id_user'], 'integer'],
            [['toggle'], 'boolean'],
            [['date_modified', 'date_created'], 'safe'],
            [['id_assignment', 'id_user'], 'unique', 'targetAttribute' => ['id_assignment', 'id_user'], 'message' => 'The combination of Id Assignment and Id User has already been taken.'],
            [['id_assignment'], 'exist', 'skipOnError' => true, 'targetClass' => Assignment::className(), 'targetAttribute' => ['id_assignment' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'id_assignment' => \Yii::t('app', 'Id Assignment'),
            'id_user' => \Yii::t('app', 'Id User'),
            'toggle' => \Yii::t('app', 'Toggle'),
            'date_modified' => \Yii::t('app', 'Date Modified'),
            'date_created' => \Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAssignment()
    {
        return $this->hasOne(Assignment::className(), ['id' => 'id_assignment']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
