<?php

namespace lawiet\rbac\models;

use Yii;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/**
 * This is the model class for table "group".
 *
 * @property string $id
 * @property int $status
 * @property string $name
 * @property string $date_modified
 * @property string $date_created
 *
 * @property GroupRole[] $groupRoles
 * @property Role[] $rols
 * @property Organization[] $organizations
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name'], 'required'],
            [['date_modified', 'date_created'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
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
			'name'=>[
				'type'=>Form::INPUT_TEXT, 
				'options'=>[
					'placeholder'=>Yii::t('app','Enter a Name...'),
				],
			],
			'rols'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\kartik\widgets\Select2', 
				'options'=>[
					'data'=>ArrayHelper::map(Role::find()->where(['status'=>true])->all(), 'id', 'name'),
					'options' => [
						'placeholder' => Yii::t("app", "Select a role"),
						'multiple'=>true, 
						'required' => true,
					],
					'pluginOptions' => [
						//'tags' => true,
						'allowClear' => false,
						'tokenSeparators' => [',', ' '],
						'maximumInputLength' => 10,
					],
				], 
				//'hint'=>Yii::t('app','Select a group...'),
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
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'Name'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupRoles()
    {
        return $this->hasMany(GroupRole::className(), ['id_group' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRols()
    {
        return $this->hasMany(Role::className(), ['id' => 'id_role'])->viaTable('group_role', ['id_group' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['id_group' => 'id']);
    }
}
