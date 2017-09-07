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
class Users extends \yii\db\ActiveRecord
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
            [['username', 'email'], 'unique', 'targetAttribute' => ['username', 'email'], 'message' => 'The combination of Email and Username has already been taken.'],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'last_conection' => 'Last Conection',
            'last_activity' => 'Last Activity',
            'token_security' => 'Token Security',
            'date_expired_token_security' => 'Date Expired Token Security',
            'token_recovery_password' => 'Token Recovery Password',
            'date_token_recovery_password' => 'Date Token Recovery Password',
            'date_modified' => 'Date Modified',
            'date_created' => 'Date Created',
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
