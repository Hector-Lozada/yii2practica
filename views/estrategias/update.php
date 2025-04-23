<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Estrategias $model */

$this->title = Yii::t('app', 'Update Estrategias: {name}', [
    'name' => $model->idestrategias,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estrategias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idestrategias, 'url' => ['view', 'idestrategias' => $model->idestrategias]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="estrategias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
