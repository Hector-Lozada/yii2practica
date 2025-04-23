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
            [['idTrades', 'estrategia_id'], 'integer'],
            [['simbolo', 'fecha', 'comentario'], 'safe'],
            [['precio_entrada', 'precio_salida', 'pnl'], 'number'],
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
            'idTrades' => $this->idTrades,
            'precio_entrada' => $this->precio_entrada,
            'precio_salida' => $this->precio_salida,
            'pnl' => $this->pnl,
            'fecha' => $this->fecha,
            'estrategia_id' => $this->estrategia_id,
        ]);

        $query->andFilterWhere(['like', 'simbolo', $this->simbolo])
            ->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}
