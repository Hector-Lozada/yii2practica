<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Strategies $model */

$this->title = Yii::t('app', 'Create Strategies');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Strategies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strategies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
