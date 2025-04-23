<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lessons $model */

$this->title = Yii::t('app', 'Update Lessons: {name}', [
    'name' => $model->idlessons,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idlessons, 'url' => ['view', 'idlessons' => $model->idlessons]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lessons-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
