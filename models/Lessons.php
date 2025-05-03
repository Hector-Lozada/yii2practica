<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

class Lessons extends \yii\db\ActiveRecord
{
    public $videoFile;

    public static function tableName()
    {
        return 'lessons';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['course_id', 'strategy_id'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['video_path'], 'string', 'max' => 255],
            [['videoFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'mp4, avi, mov', 'maxSize' => 50 * 1024 * 1024],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_id' => 'course_id']],
            [['strategy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Strategies::class, 'targetAttribute' => ['strategy_id' => 'strategy_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'lesson_id' => 'ID',
            'course_id' => 'Curso',
            'strategy_id' => 'Estrategia',
            'title' => 'Título',
            'content' => 'Contenido',
            'video_path' => 'Video',
            'videoFile' => 'Archivo de Video',
            'created_at' => 'Creado',
        ];
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord && !$this->videoFile) {
            $this->addError('videoFile', 'Debe subir un archivo de video.');
        }
        return parent::beforeValidate();
    }
}