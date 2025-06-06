<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Strategies;

/**
 * StrategiesSearch represents the model behind the search form of `app\models\Strategies`.
 */
class StrategiesSearch extends Strategies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['strategy_id'], 'integer'],
            [['strategy_name', 'description', 'created_at'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Strategies::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'strategy_id' => $this->strategy_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'strategy_name', $this->strategy_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
