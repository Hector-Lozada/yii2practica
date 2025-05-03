<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Trades;

/**
 * TradesSearch represents the model behind the search form of `app\models\Trades`.
 */
class TradesSearch extends Trades
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trade_id', 'user_id', 'lesson_id', 'strategy_id'], 'integer'],
            [['entry_price', 'exit_price'], 'number'],
            [['entry_date', 'exit_date', 'description', 'image_path', 'created_at'], 'safe'],
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
        $query = Trades::find();

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
            'trade_id' => $this->trade_id,
            'user_id' => $this->user_id,
            'lesson_id' => $this->lesson_id,
            'strategy_id' => $this->strategy_id,
            'entry_price' => $this->entry_price,
            'exit_price' => $this->exit_price,
            'entry_date' => $this->entry_date,
            'exit_date' => $this->exit_date,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image_path', $this->image_path]);

        return $dataProvider;
    }
}
