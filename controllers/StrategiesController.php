<?php

namespace app\controllers;

use app\models\Strategies;
use app\models\StrategiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StrategiesController implements the CRUD actions for Strategies model.
 */
class StrategiesController extends Controller
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
     * Lists all Strategies models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StrategiesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Strategies model.
     * @param int $strategy_id Strategy ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($strategy_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($strategy_id),
        ]);
    }

    /**
     * Creates a new Strategies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Strategies();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'strategy_id' => $model->strategy_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Strategies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $strategy_id Strategy ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($strategy_id)
    {
        $model = $this->findModel($strategy_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'strategy_id' => $model->strategy_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Strategies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $strategy_id Strategy ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($strategy_id)
    {
        $this->findModel($strategy_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Strategies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $strategy_id Strategy ID
     * @return Strategies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($strategy_id)
    {
        if (($model = Strategies::findOne(['strategy_id' => $strategy_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
