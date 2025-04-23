<?php

namespace app\controllers;

use app\models\Estrategias;
use app\models\EstrategiasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstrategiasController implements the CRUD actions for Estrategias model.
 */
class EstrategiasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Estrategias models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EstrategiasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estrategias model.
     * @param int $idestrategias Idestrategias
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idestrategias)
    {
        return $this->render('view', [
            'model' => $this->findModel($idestrategias),
        ]);
    }

    /**
     * Creates a new Estrategias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Estrategias();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idestrategias' => $model->idestrategias]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Estrategias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idestrategias Idestrategias
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idestrategias)
    {
        $model = $this->findModel($idestrategias);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idestrategias' => $model->idestrategias]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estrategias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idestrategias Idestrategias
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idestrategias)
    {
        $this->findModel($idestrategias)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Estrategias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idestrategias Idestrategias
     * @return Estrategias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idestrategias)
    {
        if (($model = Estrategias::findOne(['idestrategias' => $idestrategias])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
