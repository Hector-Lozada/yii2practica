<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Strategies $model */

$this->title = Yii::t('app', 'Update Strategies: {name}', [
    'name' => $model->strategy_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Strategies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->strategy_id, 'url' => ['view', 'strategy_id' => $model->strategy_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="strategies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
