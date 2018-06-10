<?php

namespace lawiet\rbac\models;

use Yii;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/**
 * This is the model class for table "organization".
 *
 * @property string $id
 * @property string $id_group
 * @property int $status
 * @property string $name
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Group $group
 * @property User[] $users
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_group', 'status'], 'integer'],
            [['id_group', 'name'], 'required'],
            [['date_modified', 'date_created'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['id_group', 'name'], 'unique', 'targetAttribute' => ['id_group', 'name']],
            [['id_group'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['id_group' => 'id']],
        ];
    }
	
    /**
     * {@inheritdoc}
     */
	public function getFormAttribs() {
		$o = Group::find();
		if(Yii::$app->user->identity->id < 2){
			$o = $o->where(['status'=>true]);
		}else{
			$o = $o->where(['>', 'id', '1'])->andWhere(['status'=>true]);
		}
		$o = $o->all();
		
		return [
			'status'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\kartik\widgets\SwitchInput', 
			],
			'id_group'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\kartik\widgets\Select2', 
				'options'=>[
					'data'=>ArrayHelper::map(Group::find()->where(['status'=>true])->all(), 'id', 'name'),
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
		];
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_group' => Yii::t('app', 'Id Group'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'Name'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'id_group']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_organization' => 'id']);
    }
}
