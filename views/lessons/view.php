<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Lessons $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lessons-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'lesson_id' => $model->lesson_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'lesson_id' => $model->lesson_id], [
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
            'lesson_id',
            [
                'attribute' => 'course_id',
                'value' => $model->course->name ?? 'N/A', // Muestra el nombre del curso
            ],
            [
                'attribute' => 'strategy_id',
                'value' => $model->strategy->name ?? 'N/A', // Muestra el nombre de la estrategia
            ],
            'title',
            'content:ntext',
            [
                'attribute' => 'video_path',
                'format' => 'raw',
                'value' => function($model) {
                    if ($model->video_path) {
                        // Para videos locales
                        if (strpos($model->video_path, 'http') === false) {
                            $videoPath = Yii::getAlias('@web') . $model->video_path;
                            return Html::tag('div', 
                                Html::tag('video', Html::tag('source', '', [
                                    'src' => $videoPath,
                                    'type' => 'video/mp4'
                                ]), [
                                    'controls' => true,
                                    'width' => '100%',
                                    'style' => 'max-width: 800px;'
                                ]),
                                ['class' => 'video-container']
                            );
                        }
                        // Para videos embebidos (YouTube, Vimeo, etc.)
                        return Html::tag('div', 
                            Html::tag('iframe', '', [
                                'src' => $model->video_path,
                                'width' => '100%',
                                'height' => '450',
                                'frameborder' => '0',
                                'allow' => 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture',
                                'allowfullscreen' => true,
                                'style' => 'max-width: 800px;'
                            ]),
                            ['class' => 'video-container']
                        );
                    }
                    return 'No hay video disponible';
                },
            ],
            'created_at:datetime',
        ],
    ]) ?>

</div>