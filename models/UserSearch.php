<?php

namespace lawiet\rbac\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use lawiet\rbac\models\User;

/**
 * UserSearch represents the model behind the search form of `lawiet\rbac\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_status', 'id_organization', 'date_expired_token_security'], 'integer'],
            [['email', 'username', 'password', 'last_conection', 'last_activity', 'token_security', 'token_recovery_password', 'date_token_recovery_password', 'date_modified', 'date_created'], 'safe'],
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
        $query = User::find();

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
            'id_status' => $this->id_status,
            'id_organization' => $this->id_organization,
            'last_conection' => $this->last_conection,
            'last_activity' => $this->last_activity,
            'date_expired_token_security' => $this->date_expired_token_security,
            'date_token_recovery_password' => $this->date_token_recovery_password,
            'date_modified' => $this->date_modified,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'token_security', $this->token_security])
            ->andFilterWhere(['like', 'token_recovery_password', $this->token_recovery_password]);

        return $dataProvider;
    }
}
