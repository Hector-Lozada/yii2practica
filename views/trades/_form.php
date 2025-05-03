<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Trades $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="trades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'lesson_id')->textInput() ?>

    <?= $form->field($model, 'strategy_id')->textInput() ?>

    <?= $form->field($model, 'entry_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entry_date')->textInput() ?>

    <?= $form->field($model, 'exit_date')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <small class="text-muted">Formatos permitidos: png, jpg, jpeg, gif (max 5MB)</small>

    <?php if (!$model->isNewRecord && $model->image_path): ?>
        <div class="form-group">
            <label>Imagen Actual</label>
            <div>
                <img src="<?= $model->image_path ?>" alt="Imagen del trade" style="max-width: 200px; max-height: 200px;">
            </div>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
