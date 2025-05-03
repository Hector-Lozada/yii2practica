<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "trades".
 */
class Trades extends \yii\db\ActiveRecord
{
    public $imageFile; // Atributo para el archivo de imagen
    
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
            [['entry_price', 'entry_date'], 'required'],
            [['user_id', 'lesson_id', 'strategy_id'], 'integer'],
            [['entry_price', 'exit_price'], 'number'],
            [['entry_date', 'exit_date', 'created_at'], 'safe'],
            [['description'], 'string'],
            [['image_path'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 5 * 1024 * 1024], // 5MB
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
            'trade_id' => 'ID',
            'user_id' => 'Usuario',
            'lesson_id' => 'Lección',
            'strategy_id' => 'Estrategia',
            'entry_price' => 'Precio de Entrada',
            'exit_price' => 'Precio de Salida',
            'entry_date' => 'Fecha de Entrada',
            'exit_date' => 'Fecha de Salida',
            'description' => 'Descripción',
            'image_path' => 'Imagen',
            'imageFile' => 'Subir Imagen',
            'created_at' => 'Creado',
        ];
    }

    /**
     * Sube la imagen al servidor
     */
    public function upload()
    {
        if ($this->imageFile) {
            $uploadDir = Yii::getAlias('@webroot/uploads/images/');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $fileName = uniqid() . '.' . $this->imageFile->extension;
            $filePath = $uploadDir . $fileName;

            if ($this->imageFile->saveAs($filePath)) {
                $this->image_path = '/uploads/images/' . $fileName;
                return true;
            }
        }
        return false;
    }

    /**
     * Elimina la imagen asociada
     */
    public function deleteImage()
    {
        if ($this->image_path && file_exists(Yii::getAlias('@webroot' . $this->image_path))) {
            unlink(Yii::getAlias('@webroot' . $this->image_path));
            return true;
        }
        return false;
    }

    /**
     * Before delete hook
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $this->deleteImage();
        return true;
    }

    // ... (mantén tus relaciones existentes)

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