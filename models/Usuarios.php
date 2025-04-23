<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $idusuarios
 * @property string|null $nombre
 * @property string|null $email
 * @property string|null $password
 * @property string|null $creado_en
 * @property int $Trades_idTrades
 *
 * @property Modulos[] $modulos
 * @property Trades $tradesIdTrades
 */
class Usuarios extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'email', 'password', 'creado_en'], 'default', 'value' => null],
            [['creado_en'], 'safe'],
            [['Trades_idTrades'], 'required'],
            [['Trades_idTrades'], 'integer'],
            [['nombre', 'email'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
            [['Trades_idTrades'], 'exist', 'skipOnError' => true, 'targetClass' => Trades::class, 'targetAttribute' => ['Trades_idTrades' => 'idTrades']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idusuarios' => Yii::t('app', 'Idusuarios'),
            'nombre' => Yii::t('app', 'Nombre'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'creado_en' => Yii::t('app', 'Creado En'),
            'Trades_idTrades' => Yii::t('app', 'Trades Id Trades'),
        ];
    }

    /**
     * Gets query for [[Modulos]].
     *
     * @return \yii\db\ActiveQuery|ModulosQuery
     */
    public function getModulos()
    {
        return $this->hasMany(Modulos::class, ['usuarios_idusuarios' => 'idusuarios']);
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
     * @return UsuariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosQuery(get_called_class());
    }

}
