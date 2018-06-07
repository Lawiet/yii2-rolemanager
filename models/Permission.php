<?php

namespace lawiet\rbac\models;

use Yii;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/**
 * This is the model class for table "permission".
 *
 * @property string $id
 * @property string $id_permission
 * @property int $status
 * @property int $logged
 * @property int $show_in_menu
 * @property string $name
 * @property string $uri
 * @property string $icon
 * @property string $data_method
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Assignment[] $assignments
 * @property Permission $permission
 * @property Permission[] $permissions
 * @property PermissionRole[] $permissionRoles
 * @property Role[] $rols
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_permission', 'status', 'logged', 'show_in_menu'], 'integer'],
            [['name', 'uri'], 'required'],
            [['date_modified', 'date_created'], 'safe'],
            [['name'], 'string', 'max' => 32],
            [['uri'], 'string', 'max' => 150],
            [['icon'], 'string', 'max' => 16],
            [['data_method'], 'string', 'max' => 255],
            [['name', 'uri'], 'unique', 'targetAttribute' => ['name', 'uri']],
            [['id_permission', 'name', 'uri'], 'unique', 'targetAttribute' => ['id_permission', 'name', 'uri']],
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
			'logged'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\kartik\widgets\SwitchInput', 
			],
			'show_in_menu'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\kartik\widgets\SwitchInput', 
			],
			'data_method'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\kartik\widgets\Select2', 
				'options'=>[
					'data'=>['GET'=>'GET', 'POST'=>'POST', 'PUT'=>'PUT', 'DELETE'=>'DELETE'],
					'options' => [
						'placeholder' => Yii::t("app", "Select a method"),
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
			'uri'=>[
				'type'=>Form::INPUT_TEXT,  
				'options'=>[
					'placeholder'=>Yii::t('app','Enter a Relative URL...'),
				],
			],
			'icon'=>[
				'type'=>Form::INPUT_TEXT, 
				'options'=>[
					'placeholder'=>Yii::t('app','Enter a Icon...'),
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
            'logged' => Yii::t('app', 'Logged'),
            'show_in_menu' => Yii::t('app', 'Show In Menu'),
            'name' => Yii::t('app', 'Name'),
            'uri' => Yii::t('app', 'Uri'),
            'icon' => Yii::t('app', 'Icon'),
            'data_method' => Yii::t('app', 'Data Method'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['id_permission' => 'id']);
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
    public function getPermissions()
    {
        return $this->hasMany(Permission::className(), ['id_permission' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissionRoles()
    {
        return $this->hasMany(PermissionRole::className(), ['id_permission' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRols()
    {
        return $this->hasMany(Role::className(), ['id' => 'id_role'])->viaTable('permission_role', ['id_permission' => 'id']);
    }
}
