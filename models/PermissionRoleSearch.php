<?php

namespace lawiet\rbac\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use lawiet\rbac\models\PermissionRole;

/**
 * PermissionRoleSearch represents the model behind the search form of `lawiet\rbac\models\PermissionRole`.
 */
class PermissionRoleSearch extends PermissionRole
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_permission', 'id_rol'], 'integer'],
            [['date_modified', 'date_created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PermissionRole::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_permission' => $this->id_permission,
            'id_rol' => $this->id_rol,
            'date_modified' => $this->date_modified,
            'date_created' => $this->date_created,
        ]);

        return $dataProvider;
    }
}
