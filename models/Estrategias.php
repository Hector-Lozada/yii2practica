<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estrategias".
 *
 * @property int $idestrategias
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property int $lessons_idlessons
 * @property int $Trades_idTrades
 *
 * @property Lessons $lessonsIdlessons
 * @property Trades $tradesIdTrades
 */
class Estrategias extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estrategias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'default', 'value' => null],
            [['lessons_idlessons', 'Trades_idTrades'], 'required'],
            [['lessons_idlessons', 'Trades_idTrades'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 255],
            [['lessons_idlessons'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::class, 'targetAttribute' => ['lessons_idlessons' => 'idlessons']],
            [['Trades_idTrades'], 'exist', 'skipOnError' => true, 'targetClass' => Trades::class, 'targetAttribute' => ['Trades_idTrades' => 'idTrades']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idestrategias' => Yii::t('app', 'Idestrategias'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'lessons_idlessons' => Yii::t('app', 'Lessons Idlessons'),
            'Trades_idTrades' => Yii::t('app', 'Trades Id Trades'),
        ];
    }

    /**
     * Gets query for [[LessonsIdlessons]].
     *
     * @return \yii\db\ActiveQuery|LessonsQuery
     */
    public function getLessonsIdlessons()
    {
        return $this->hasOne(Lessons::class, ['idlessons' => 'lessons_idlessons']);
    }

    /**
     * Gets query for [[TradesIdTrades]].
     *
     * @return \yii\db\ActiveQuery|TradesQuery
     */
    public function getTradesIdTrades()
    {
        return $this->hasOne(Trades::class, ['idTrades' => 'Trades_idTrades']);
    }

    /**
     * {@inheritdoc}
     * @return EstrategiasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstrategiasQuery(get_called_class());
    }

}
