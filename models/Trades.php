<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trades".
 *
 * @property int $trade_id
 * @property int|null $user_id
 * @property int|null $lesson_id
 * @property int|null $strategy_id
 * @property float $entry_price
 * @property float|null $exit_price
 * @property string $entry_date
 * @property string|null $exit_date
 * @property string|null $description
 * @property string|null $image_path
 * @property string|null $created_at
 *
 * @property Lessons $lesson
 * @property Strategies $strategy
 * @property Users $user
 */
class Trades extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'lesson_id', 'strategy_id', 'exit_price', 'exit_date', 'description', 'image_path'], 'default', 'value' => null],
            [['user_id', 'lesson_id', 'strategy_id'], 'integer'],
            [['entry_price', 'entry_date'], 'required'],
            [['entry_price', 'exit_price'], 'number'],
            [['entry_date', 'exit_date', 'created_at'], 'safe'],
            [['description'], 'string'],
            [['image_path'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'user_id']],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::class, 'targetAttribute' => ['lesson_id' => 'lesson_id']],
            [['strategy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Strategies::class, 'targetAttribute' => ['strategy_id' => 'strategy_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'trade_id' => Yii::t('app', 'Trade ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'lesson_id' => Yii::t('app', 'Lesson ID'),
            'strategy_id' => Yii::t('app', 'Strategy ID'),
            'entry_price' => Yii::t('app', 'Entry Price'),
            'exit_price' => Yii::t('app', 'Exit Price'),
            'entry_date' => Yii::t('app', 'Entry Date'),
            'exit_date' => Yii::t('app', 'Exit Date'),
            'description' => Yii::t('app', 'Description'),
            'image_path' => Yii::t('app', 'Image Path'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Lesson]].
     *
     * @return \yii\db\ActiveQuery|LessonsQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lessons::class, ['lesson_id' => 'lesson_id']);
    }

    /**
     * Gets query for [[Strategy]].
     *
     * @return \yii\db\ActiveQuery|StrategiesQuery
     */
    public function getStrategy()
    {
        return $this->hasOne(Strategies::class, ['strategy_id' => 'strategy_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['user_id' => 'user_id']);
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
