<?php

namespace lawiet\rbac\models;

use Yii;

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
