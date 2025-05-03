<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property int $course_id
 * @property string $course_name
 * @property string|null $description
 * @property string|null $created_at
 *
 * @property Lessons[] $lessons
 */
class Courses extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['course_name'], 'required'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['course_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'course_id' => Yii::t('app', 'Course ID'),
            'course_name' => Yii::t('app', 'Course Name'),
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
        return $this->hasMany(Lessons::class, ['course_id' => 'course_id']);
    }

    /**
     * {@inheritdoc}
     * @return CoursesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CoursesQuery(get_called_class());
    }

}
