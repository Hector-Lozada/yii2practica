<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lessons $model */

$this->title = Yii::t('app', 'Create Lessons');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
