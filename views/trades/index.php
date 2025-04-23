<?php

use app\models\Trades;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TradesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Trades');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trades-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Trades'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idTrades',
            'simbolo',
            'precio_entrada',
            'precio_salida',
            'pnl',
            //'fecha',
            //'comentario:ntext',
            //'estrategia_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Trades $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idTrades' => $model->idTrades]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
