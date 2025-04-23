<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lessons".
 *
 * @property int $idlessons
 * @property int|null $id_modules
 * @property string|null $titulo
 * @property string|null $videourl
 *
 * @property Estrategias[] $estrategias
 * @property Modulos $idlessons0
 */
class Lessons extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_modules', 'titulo', 'videourl'], 'default', 'value' => null],
            [['id_modules'], 'integer'],
            [['titulo'], 'string', 'max' => 100],
            [['videourl'], 'string', 'max' => 255],
            [['idlessons'], 'exist', 'skipOnError' => true, 'targetClass' => Modulos::class, 'targetAttribute' => ['idlessons' => 'idmodulos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idlessons' => Yii::t('app', 'Idlessons'),
            'id_modules' => Yii::t('app', 'Id Modules'),
            'titulo' => Yii::t('app', 'Titulo'),
            'videourl' => Yii::t('app', 'Videourl'),
        ];
    }

    /**
     * Gets query for [[Estrategias]].
     *
     * @return \yii\db\ActiveQuery|EstrategiasQuery
     */
    public function getEstrategias()
    {
        return $this->hasMany(Estrategias::class, ['lessons_idlessons' => 'idlessons']);
    }

    /**
     * Gets query for [[Idlessons0]].
     *
     * @return \yii\db\ActiveQuery|ModulosQuery
     */
    public function getIdlessons0()
    {
        return $this->hasOne(Modulos::class, ['idmodulos' => 'idlessons']);
    }

    /**
     * {@inheritdoc}
     * @return LessonsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LessonsQuery(get_called_class());
    }

}
