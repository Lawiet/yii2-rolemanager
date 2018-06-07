<?php

namespace lawiet\rbac\models;

use Yii;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $id_status
 * @property string $id_organization
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $last_conection
 * @property string $last_activity
 * @property string $token_security
 * @property int $date_expired_token_security
 * @property string $token_recovery_password
 * @property string $date_token_recovery_password
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Audit[] $audits
 * @property AssignmentUser[] $assignmentUsers
 * @property Assignment[] $assignments
 * @property RoleUser[] $roleUsers
 * @property Role[] $roles
 * @property Organization $organization
 * @property UserStatus $status
 */
class User extends UserIdentity
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_status', 'id_organization', 'username', 'email', 'password'], 'required'],
            [['id_status', 'id_organization', 'date_expired_token_security'], 'integer'],
            [['last_conection', 'last_activity', 'date_token_recovery_password', 'date_modified', 'date_created'], 'safe'],
            [['email'], 'string', 'max' => 180],
            [['username'], 'string', 'max' => 64],
            [['password', 'token_security', 'token_recovery_password'], 'string', 'max' => 512],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email', 'username'], 'unique', 'targetAttribute' => ['email', 'username']],
            [['id_organization'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['id_organization' => 'id']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => UserStatus::className(), 'targetAttribute' => ['id_status' => 'id']],
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
			'id_organization'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\kartik\widgets\Select2', 
				'options'=>[
					'data'=>ArrayHelper::map(Organization::find()->where(['status'=>true])->all(), 'id', 'name'),
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
			'username'=>[
				'type'=>Form::INPUT_TEXT, 
				'options'=>[
					'placeholder'=>Yii::t('app','Enter a UserName...'),
				],
			],
			'email'=>[
				'type'=>Form::INPUT_WIDGET, 
				'widgetClass'=>'\yii\widgets\MaskedInput', 
				'options'=>[
					'clientOptions' => [
						'alias' =>  'email',
					],
				],
			],
			'password'=>[
				'type'=>Form::INPUT_PASSWORD, 
				'options'=>[
					'placeholder'=>Yii::t('app','Enter a Password...'),
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
            'id_status' => Yii::t('app', 'Id Status'),
            'id_organization' => Yii::t('app', 'Id Organization'),
            'email' => Yii::t('app', 'Email'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'last_conection' => Yii::t('app', 'Last Conection'),
            'last_activity' => Yii::t('app', 'Last Activity'),
            'token_security' => Yii::t('app', 'Token Security'),
            'date_expired_token_security' => Yii::t('app', 'Date Expired Token Security'),
            'token_recovery_password' => Yii::t('app', 'Token Recovery Password'),
            'date_token_recovery_password' => Yii::t('app', 'Date Token Recovery Password'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudits()
    {
        return $this->hasMany(Audit::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignmentUsers()
    {
        return $this->hasMany(AssignmentUser::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['id' => 'id_assignment'])->viaTable('assignment_user', ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleUsers()
    {
        return $this->hasMany(RoleUser::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Role::className(), ['id' => 'id_role'])->viaTable('role_user', ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'id_organization']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(UserStatus::className(), ['id' => 'id_status']);
    }
}
