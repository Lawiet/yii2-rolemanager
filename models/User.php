<?php

namespace lawiet\rbac\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $status
 * @property string $id_organization
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $last_conection
 * @property string $last_activity
 * @property string $token_security
 * @property integer $date_expired_token_security
 * @property string $token_recovery_password
 * @property string $date_token_recovery_password
 * @property string $date_modified
 * @property string $date_created
 *
 * @property Audit[] $audits
 * @property AssignmentUser[] $assignmentUsers
 * @property Assignment[] $idAssignments
 * @property RoleUser[] $roleUsers
 * @property Role[] $idRols
 * @property Organization $idOrganization
 */
class User extends UserIdentity
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_organization', 'username', 'password'], 'required'],
            [['id_organization', 'date_expired_token_security'], 'integer'],
            [['last_conection', 'last_activity', 'date_token_recovery_password', 'date_modified', 'date_created'], 'safe'],
            [['status'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 180],
            [['username'], 'string', 'max' => 64],
            [['password', 'token_security', 'token_recovery_password'], 'string', 'max' => 512],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email', 'username'], 'unique', 'targetAttribute' => ['email', 'username'], 'message' => 'The combination of Email and Username has already been taken.'],
            [['id_organization'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['id_organization' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
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
    public function getIdAssignments()
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
    public function getIdRols()
    {
        return $this->hasMany(Role::className(), ['id' => 'id_rol'])->viaTable('role_user', ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'id_organization']);
    }

    /**
     * @inheritdoc
     */
	public function beforeSave($insert)
	{
	    // hash password on before saving the record:
        $this->date_modified = new \yii\db\Expression('NOW()');
		return parent::beforeSave($insert);
	}
}
