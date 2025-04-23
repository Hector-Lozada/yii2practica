<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Modulos $model */

$this->title = Yii::t('app', 'Create Modulos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modulos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modulos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
