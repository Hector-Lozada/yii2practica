<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Trades $model */

$this->title = Yii::t('app', 'Create Trades');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
