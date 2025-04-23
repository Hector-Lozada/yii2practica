<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Trades".
 *
 * @property int $idTrades
 * @property string|null $simbolo
 * @property float|null $precio_entrada
 * @property float|null $precio_salida
 * @property float|null $pnl
 * @property string|null $fecha
 * @property string|null $comentario
 * @property int|null $estrategia_id
 *
 * @property Estrategias[] $estrategias
 * @property Usuarios[] $usuarios
 */
class Trades extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Trades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['simbolo', 'precio_entrada', 'precio_salida', 'pnl', 'fecha', 'comentario', 'estrategia_id'], 'default', 'value' => null],
            [['precio_entrada', 'precio_salida', 'pnl'], 'number'],
            [['fecha'], 'safe'],
            [['comentario'], 'string'],
            [['estrategia_id'], 'integer'],
            [['simbolo'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTrades' => Yii::t('app', 'Id Trades'),
            'simbolo' => Yii::t('app', 'Simbolo'),
            'precio_entrada' => Yii::t('app', 'Precio Entrada'),
            'precio_salida' => Yii::t('app', 'Precio Salida'),
            'pnl' => Yii::t('app', 'Pnl'),
            'fecha' => Yii::t('app', 'Fecha'),
            'comentario' => Yii::t('app', 'Comentario'),
            'estrategia_id' => Yii::t('app', 'Estrategia ID'),
        ];
    }

    /**
     * Gets query for [[Estrategias]].
     *
     * @return \yii\db\ActiveQuery|EstrategiasQuery
     */
    public function getEstrategias()
    {
        return $this->hasMany(Estrategias::class, ['Trades_idTrades' => 'idTrades']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::class, ['Trades_idTrades' => 'idTrades']);
    }

    /**
     * {@inheritdoc}
     * @return TradesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TradesQuery(get_called_class());
    }

}
