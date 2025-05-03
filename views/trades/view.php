<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\i18n\Formatter;
/** @var yii\web\View $this */
/** @var app\models\Trades $model */

$this->title = 'Trade #' . $model->trade_id;
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
            [
                'attribute' => 'user_id',
                'value' => $model->user->username ?? 'N/A', // Muestra el nombre de usuario
            ],
            [
                'attribute' => 'lesson_id',
                'value' => $model->lesson->title ?? 'N/A', // Muestra el título de la lección
            ],
            [
                'attribute' => 'strategy_id',
                'value' => $model->strategy->name ?? 'N/A', // Muestra el nombre de la estrategia
            ],
            'entry_price:currency',
            'exit_price:currency',
            'entry_date:datetime',
            'exit_date:datetime',
            'description:ntext',
            [
                'attribute' => 'image_path',
                'format' => 'html',
                'value' => function($model) {
                    if ($model->image_path) {
                        return Html::img($model->image_path, [
                            'style' => 'max-width: 300px; max-height: 300px;',
                            'class' => 'img-thumbnail',
                            'alt' => 'Imagen del Trade'
                        ]);
                    }
                    return 'No hay imagen';
                },
            ],
            'created_at:datetime',
        ],
    ]) ?>

</div>