<?php

namespace app\controllers;

use app\models\Modulos;
use app\models\ModulosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModulosController implements the CRUD actions for Modulos model.
 */
class ModulosController extends Controller
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
     * Lists all Modulos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ModulosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Modulos model.
     * @param int $idmodulos Idmodulos
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idmodulos)
    {
        return $this->render('view', [
            'model' => $this->findModel($idmodulos),
        ]);
    }

    /**
     * Creates a new Modulos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Modulos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idmodulos' => $model->idmodulos]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Modulos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idmodulos Idmodulos
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idmodulos)
    {
        $model = $this->findModel($idmodulos);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idmodulos' => $model->idmodulos]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Modulos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idmodulos Idmodulos
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idmodulos)
    {
        $this->findModel($idmodulos)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Modulos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idmodulos Idmodulos
     * @return Modulos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idmodulos)
    {
        if (($model = Modulos::findOne(['idmodulos' => $idmodulos])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
