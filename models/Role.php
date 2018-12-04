<?php

namespace lawiet\rbac\models;

use Yii;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/**
 * This is the model class for table "role".
 *
 * @property string $id
 * @property int $status
 * @property string $name
 * @property string $date_modified
 * @property string $date_created
 *
 * @property GroupRole[] $groupRoles
 * @property Group[] $groups
 * @property PermissionRole[] $permissionRoles
 * @property Permission[] $permissions
 * @property RoleUser[] $roleUsers
 * @property User[] $users
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
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
			'permissions'=>[
				'type'=>Form::INPUT_WIDGET,
				'widgetClass'=>'\kartik\widgets\Select2',
				'options'=>[
					'data'=>ArrayHelper::map(Permission::find()->where(['status'=>true])->all(), 'id', 'name'),
					'options' => [
						'placeholder' => Yii::t("app", "Select a permission"),
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
        return $this->hasMany(GroupRole::className(), ['id_role' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['id' => 'id_group'])->viaTable('group_role', ['id_role' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissionRoles()
    {
        return $this->hasMany(PermissionRole::className(), ['id_role' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(Permission::className(), ['id' => 'id_permission'])->viaTable('permission_role', ['id_role' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleUsers()
    {
        return $this->hasMany(RoleUser::className(), ['id_role' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'id_user'])->viaTable('role_user', ['id_role' => 'id']);
    }
}
