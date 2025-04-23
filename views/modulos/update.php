<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Modulos $model */

$this->title = Yii::t('app', 'Update Modulos: {name}', [
    'name' => $model->idmodulos,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modulos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmodulos, 'url' => ['view', 'idmodulos' => $model->idmodulos]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="modulos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
