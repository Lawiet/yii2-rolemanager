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
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $status
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
 * @property string $cedula
 * @property string $nombres
 * @property string $apellidos
 *
 * @property AssignmentsUsers[] $assignmentsUsers
 * @property Assignments[] $idAssignments
 * @property RolesUsers[] $rolesUsers
 * @property Roles[] $idRols
 */
class Users extends User
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'string'],
            [['username', 'password'], 'required'],
            [['last_conection', 'last_activity', 'date_token_recovery_password', 'date_modified', 'date_created'], 'safe'],
            [['date_expired_token_security'], 'integer'],
            [['email', 'password', 'token_security', 'token_recovery_password'], 'string', 'max' => 512],
            [['username'], 'string', 'max' => 64],
            [['email'], 'unique'],
            [['username', 'email'], 'unique', 'targetAttribute' => ['username', 'email'], 'message' => Yii::t('app', 'The combination of Email and Username has already been taken.')],
            [['username'], 'unique'],
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
    public function getAssignmentsUsers()
    {
        return $this->hasMany(AssignmentsUsers::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAssignments()
    {
        return $this->hasMany(Assignments::className(), ['id' => 'id_assignment'])->viaTable('assignments_users', ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolesUsers()
    {
        return $this->hasMany(RolesUsers::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRols()
    {
        return $this->hasMany(Roles::className(), ['id' => 'id_rol'])->viaTable('roles_users', ['id_user' => 'id']);
    }
}
