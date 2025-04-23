<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Trades $model */

$this->title = Yii::t('app', 'Update Trades: {name}', [
    'name' => $model->idTrades,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTrades, 'url' => ['view', 'idTrades' => $model->idTrades]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="trades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
