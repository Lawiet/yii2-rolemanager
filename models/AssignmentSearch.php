<?php

namespace lawiet\rbac\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use lawiet\rbac\models\Assignment;

/**
 * AssignmentSearch represents the model behind the search form about `lawiet\rbac\models\Assignment`.
 */
class AssignmentSearch extends Assignment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_permission', 'status', 'show_in_menu'], 'integer'],
            [['name', 'method', 'date_modified', 'date_created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Assignment::find();

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
            'status' => $this->status,
            'show_in_menu' => $this->show_in_menu,
            'date_modified' => $this->date_modified,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'method', $this->method]);

        return $dataProvider;
    }
}
