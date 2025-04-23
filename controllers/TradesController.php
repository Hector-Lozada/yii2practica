<?php

namespace app\controllers;

use app\models\Trades;
use app\models\TradesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TradesController implements the CRUD actions for Trades model.
 */
class TradesController extends Controller
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
     * Lists all Trades models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TradesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trades model.
     * @param int $idTrades Id Trades
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idTrades)
    {
        return $this->render('view', [
            'model' => $this->findModel($idTrades),
        ]);
    }

    /**
     * Creates a new Trades model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Trades();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idTrades' => $model->idTrades]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Trades model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idTrades Id Trades
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idTrades)
    {
        $model = $this->findModel($idTrades);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idTrades' => $model->idTrades]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Trades model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idTrades Id Trades
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idTrades)
    {
        $this->findModel($idTrades)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Trades model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idTrades Id Trades
     * @return Trades the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idTrades)
    {
        if (($model = Trades::findOne(['idTrades' => $idTrades])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
