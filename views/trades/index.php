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

            'trade_id',
            'user_id',
            'lesson_id',
            'strategy_id',
            'entry_price',
            //'exit_price',
            //'entry_date',
            //'exit_date',
            //'description:ntext',
            //'image_path',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Trades $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'trade_id' => $model->trade_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
