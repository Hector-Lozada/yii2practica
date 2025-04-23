<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modulos".
 *
 * @property int $idmodulos
 * @property string|null $titulo
 * @property string|null $descripcion
 * @property int $usuarios_idusuarios
 *
 * @property Lessons $lessons
 * @property Usuarios $usuariosIdusuarios
 */
class Modulos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modulos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion'], 'default', 'value' => null],
            [['usuarios_idusuarios'], 'required'],
            [['usuarios_idusuarios'], 'integer'],
            [['titulo'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 255],
            [['usuarios_idusuarios'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuarios_idusuarios' => 'idusuarios']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmodulos' => Yii::t('app', 'Idmodulos'),
            'titulo' => Yii::t('app', 'Titulo'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'usuarios_idusuarios' => Yii::t('app', 'Usuarios Idusuarios'),
        ];
    }

    /**
     * Gets query for [[Lessons]].
     *
     * @return \yii\db\ActiveQuery|LessonsQuery
     */
    public function getLessons()
    {
        return $this->hasOne(Lessons::class, ['idlessons' => 'idmodulos']);
    }

    /**
     * Gets query for [[UsuariosIdusuarios]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuariosIdusuarios()
    {
        return $this->hasOne(Usuarios::class, ['idusuarios' => 'usuarios_idusuarios']);
    }

    /**
     * {@inheritdoc}
     * @return ModulosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModulosQuery(get_called_class());
    }

}
