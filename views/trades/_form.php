<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Trades $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="trades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'simbolo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precio_entrada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precio_salida')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pnl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estrategia_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
