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
 * This is the model class for table "assignments".
 *
 * @property integer $id
 * @property integer $id_permission
 * @property boolean $status
 * @property boolean $show_in_menu
 * @property string $name
 * @property string $method
 * @property string $date_modified
 * @property string $date_created
 *
 * @property AssignmentsUsers[] $assignmentsUsers
 * @property Users[] $idUsers
 */
class Assignments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assignments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_permission', 'name'], 'required'],
            [['id_permission'], 'integer'],
            [['status', 'show_in_menu'], 'boolean'],
            [['method'], 'string'],
            [['date_modified', 'date_created'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['id_permission', 'method'], 'unique', 'targetAttribute' => ['id_permission', 'method'], 'message' => 'The combination of Id Permission and Method has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('rbac', 'ID'),
            'id_permission' => \Yii::t('rbac', 'Id Permission'),
            'status' => \Yii::t('rbac', 'Status'),
            'show_in_menu' => \Yii::t('rbac', 'Show In Menu'),
            'name' => \Yii::t('rbac', 'Name'),
            'method' => \Yii::t('rbac', 'Method'),
            'date_modified' => \Yii::t('rbac', 'Date Modified'),
            'date_created' => \Yii::t('rbac', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignmentsUsers()
    {
        return $this->hasMany(AssignmentsUsers::className(), ['id_assignment' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'id_user'])->viaTable('assignments_users', ['id_assignment' => 'id']);
    }
}
