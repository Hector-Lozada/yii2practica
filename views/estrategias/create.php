<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Estrategias $model */

$this->title = Yii::t('app', 'Create Estrategias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estrategias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estrategias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
