<?php

namespace app\controllers;

use Yii; // Esta es la línea que faltaba
use app\models\Trades;
use app\models\TradesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class TradesController extends Controller
{
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

    public function actionIndex()
    {
        $searchModel = new TradesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($trade_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($trade_id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Trades();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            // Validación temporal
            $model->image_path = 'temp';
            if (!$model->validate()) {
                Yii::$app->session->setFlash('error', $this->getErrorSummary($model));
                return $this->render('create', ['model' => $model]);
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Procesar imagen
                if ($model->imageFile) {
                    $uploadDir = Yii::getAlias('@webroot/uploads/images/');
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0775, true);
                    }

                    $fileName = uniqid() . '.' . $model->imageFile->extension;
                    $filePath = $uploadDir . $fileName;

                    if ($model->imageFile->saveAs($filePath)) {
                        $model->image_path = '/uploads/images/' . $fileName;
                    } else {
                        throw new \Exception('No se pudo guardar la imagen.');
                    }
                }

                if ($model->save(false)) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Trade creado exitosamente.');
                    return $this->redirect(['view', 'trade_id' => $model->trade_id]);
                } else {
                    throw new \Exception('Error al guardar: ' . print_r($model->errors, true));
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                if (isset($filePath) && file_exists($filePath)) {
                    unlink($filePath);
                }
                Yii::$app->session->setFlash('error', $e->getMessage());
                Yii::error($e->getMessage());
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($trade_id)
    {
        $model = $this->findModel($trade_id);
        $oldImagePath = $model->image_path;

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if (!$model->validate()) {
                Yii::$app->session->setFlash('error', $this->getErrorSummary($model));
                return $this->render('update', ['model' => $model]);
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Procesar nueva imagen si se subió
                if ($model->imageFile) {
                    $uploadDir = Yii::getAlias('@webroot/uploads/images/');
                    $fileName = uniqid() . '.' . $model->imageFile->extension;
                    $filePath = $uploadDir . $fileName;

                    if ($model->imageFile->saveAs($filePath)) {
                        // Eliminar la imagen anterior
                        if ($oldImagePath && file_exists(Yii::getAlias('@webroot' . $oldImagePath))) {
                            unlink(Yii::getAlias('@webroot' . $oldImagePath));
                        }
                        $model->image_path = '/uploads/images/' . $fileName;
                    } else {
                        throw new \Exception('No se pudo guardar la nueva imagen.');
                    }
                }

                if ($model->save(false)) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Trade actualizado exitosamente.');
                    return $this->redirect(['view', 'trade_id' => $model->trade_id]);
                } else {
                    throw new \Exception('Error al actualizar: ' . print_r($model->errors, true));
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
                Yii::error($e->getMessage());
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($trade_id)
    {
        $model = $this->findModel($trade_id);
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($model->delete()) {
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Trade eliminado exitosamente.');
            } else {
                throw new \Exception('No se pudo eliminar el trade.');
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', $e->getMessage());
            Yii::error($e->getMessage());
        }

        return $this->redirect(['index']);
    }

    protected function findModel($trade_id)
    {
        if (($model = Trades::findOne($trade_id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El trade solicitado no existe.');
    }

    private function getErrorSummary($model)
    {
        $errors = [];
        foreach ($model->errors as $attribute => $errorMessages) {
            $label = $model->getAttributeLabel($attribute);
            $errors[] = "$label: " . implode(', ', $errorMessages);
        }
        return implode('<br>', $errors);
    }
}