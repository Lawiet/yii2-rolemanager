<?php

namespace lawiet\rbac\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use lawiet\rbac\models\AssignmentUser;

/**
 * AssignmentUserSearch represents the model behind the search form of `lawiet\rbac\models\AssignmentUser`.
 */
class AssignmentUserSearch extends AssignmentUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_assignment', 'id_user', 'toggle'], 'integer'],
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
        $query = AssignmentUser::find();

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
            'id_assignment' => $this->id_assignment,
            'id_user' => $this->id_user,
            'toggle' => $this->toggle,
            'date_modified' => $this->date_modified,
            'date_created' => $this->date_created,
        ]);

        return $dataProvider;
    }
}
