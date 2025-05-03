<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "strategies".
 *
 * @property int $strategy_id
 * @property string $strategy_name
 * @property string|null $description
 * @property string|null $created_at
 *
 * @property Lessons[] $lessons
 * @property Trades[] $trades
 */
class Strategies extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'strategies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['strategy_name'], 'required'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['strategy_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'strategy_id' => Yii::t('app', 'Strategy ID'),
            'strategy_name' => Yii::t('app', 'Strategy Name'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Lessons]].
     *
     * @return \yii\db\ActiveQuery|LessonsQuery
     */
    public function getLessons()
    {
        return $this->hasMany(Lessons::class, ['strategy_id' => 'strategy_id']);
    }

    /**
     * Gets query for [[Trades]].
     *
     * @return \yii\db\ActiveQuery|TradesQuery
     */
    public function getTrades()
    {
        return $this->hasMany(Trades::class, ['strategy_id' => 'strategy_id']);
    }

    /**
     * {@inheritdoc}
     * @return StrategiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StrategiesQuery(get_called_class());
    }

}
