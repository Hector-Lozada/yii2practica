<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Trades $model */

$this->title = $model->trade_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trades-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'trade_id' => $model->trade_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'trade_id' => $model->trade_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'trade_id',
            'user_id',
            'lesson_id',
            'strategy_id',
            'entry_price',
            'exit_price',
            'entry_date',
            'exit_date',
            'description:ntext',
            'image_path',
            'created_at',
        ],
    ]) ?>

</div>
