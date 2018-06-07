<?php

namespace lawiet\rbac\models;

use Yii;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/**
 * This is the model class for table "assignment".
 *
 * @property string $id
 * @property string $id_permission
 * @property int $status
 * @property int $show_in_menu
 * @property string $name
 * @property string $method
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Permission $permission
 * @property AssignmentUser[] $assignmentUsers
 * @property User[] $users
 */
class Assignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_permission', 'name'], 'required'],
            [['id_permission', 'status', 'show_in_menu'], 'integer'],
            [['date_modified', 'date_created'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['method'], 'string', 'max' => 255],
            [['id_permission', 'method'], 'unique', 'targetAttribute' => ['id_permission', 'method']],
            [['id_permission'], 'exist', 'skipOnError' => true, 'targetClass' => Permission::className(), 'targetAttribute' => ['id_permission' => 'id']],
        ];
    }
	
    /**
     * {@inheritdoc}
     */
	public function getFormAttribs() {
		return [
			'status'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\kartik\widgets\SwitchInput', 
			],
			'show_in_menu'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\kartik\widgets\SwitchInput', 
			],
			'id_permission'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\kartik\widgets\Select2', 
				'options'=>[
					'data'=>ArrayHelper::map(Permission::find()->where(['status'=>true])->all(), 'id', 'name'),
					'options' => [
						'placeholder' => Yii::t("app", "Select a group"),
						'required' => true,
					],
					'pluginOptions' => [
						//'tags' => true,
						'tokenSeparators' => [',', ' '],
						'maximumInputLength' => 10,
					],
				], 
				//'hint'=>Yii::t('app','Select a group...'),
			],
			'name'=>[
				'type'=>Form::INPUT_TEXT, 
				'options'=>[
					'placeholder'=>Yii::t('app','Enter a Name...'),
				],
			],
			'method'=>[
				'type'=>Form::INPUT_TEXT, 
				'options'=>[
					'placeholder'=>Yii::t('app','Enter GET, POST, PUT or DELETE...'),
				],
			],
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
            'status' => Yii::t('app', 'Status'),
            'show_in_menu' => Yii::t('app', 'Show In Menu'),
            'name' => Yii::t('app', 'Name'),
            'method' => Yii::t('app', 'Method'),
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
    public function getAssignmentUsers()
    {
        return $this->hasMany(AssignmentUser::className(), ['id_assignment' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'id_user'])->viaTable('assignment_user', ['id_assignment' => 'id']);
    }
}
