<?php

use app\models\Estrategias;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\EstrategiasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Estrategias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estrategias-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Estrategias'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idestrategias',
            'nombre',
            'descripcion',
            'lessons_idlessons',
            'Trades_idTrades',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Estrategias $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idestrategias' => $model->idestrategias]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
