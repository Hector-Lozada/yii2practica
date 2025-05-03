<?php

namespace app\controllers;

use Yii;
use yii\web\UploadedFile;
use app\models\Lessons;
use app\models\LessonsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class LessonsController extends Controller
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
        $searchModel = new LessonsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($lesson_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($lesson_id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Lessons();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->videoFile = UploadedFile::getInstance($model, 'videoFile');

            // Validación sin video_path requerido temporalmente
            $model->video_path = 'temp'; // Valor temporal para pasar validación
            if (!$model->validate()) {
                Yii::$app->session->setFlash('error', $this->getErrorSummary($model));
                return $this->render('create', ['model' => $model]);
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Procesar archivo de video
                if ($model->videoFile) {
                    $uploadDir = Yii::getAlias('@webroot/uploads/videos/');
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0775, true);
                    }

                    $fileName = uniqid() . '_' . $model->videoFile->baseName . '.' . $model->videoFile->extension;
                    $filePath = $uploadDir . $fileName;

                    if ($model->videoFile->saveAs($filePath)) {
                        $model->video_path = '/uploads/videos/' . $fileName;
                    } else {
                        throw new \Exception('No se pudo guardar el archivo de video.');
                    }
                } else {
                    throw new \Exception('Debe subir un archivo de video.');
                }

                // Guardar el modelo
                if ($model->save(false)) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Lección creada exitosamente.');
                    return $this->redirect(['view', 'lesson_id' => $model->lesson_id]);
                } else {
                    throw new \Exception('Error al guardar: ' . print_r($model->errors, true));
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                // Eliminar archivo si se subió pero falló el guardado
                if (isset($filePath) && file_exists($filePath)) {
                    unlink($filePath);
                }
                Yii::$app->session->setFlash('error', $e->getMessage());
                Yii::error($e->getMessage());
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($lesson_id)
    {
        $model = $this->findModel($lesson_id);
        $oldVideoPath = $model->video_path;

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->videoFile = UploadedFile::getInstance($model, 'videoFile');

            // Validación
            if (!$model->validate()) {
                Yii::$app->session->setFlash('error', $this->getErrorSummary($model));
                return $this->render('update', ['model' => $model]);
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Procesar nuevo archivo si se subió
                if ($model->videoFile) {
                    $uploadDir = Yii::getAlias('@webroot/uploads/videos/');
                    $fileName = uniqid() . '_' . $model->videoFile->baseName . '.' . $model->videoFile->extension;
                    $filePath = $uploadDir . $fileName;

                    if ($model->videoFile->saveAs($filePath)) {
                        // Eliminar el video anterior
                        if ($oldVideoPath && file_exists(Yii::getAlias('@webroot' . $oldVideoPath))) {
                            unlink(Yii::getAlias('@webroot' . $oldVideoPath));
                        }
                        $model->video_path = '/uploads/videos/' . $fileName;
                    } else {
                        throw new \Exception('No se pudo guardar el nuevo archivo de video.');
                    }
                }

                // Guardar cambios
                if ($model->save(false)) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Lección actualizada exitosamente.');
                    return $this->redirect(['view', 'lesson_id' => $model->lesson_id]);
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

    public function actionDelete($lesson_id)
    {
        $model = $this->findModel($lesson_id);
        $transaction = Yii::$app->db->beginTransaction();

        try {
            // Eliminar archivo de video asociado
            if ($model->video_path && file_exists(Yii::getAlias('@webroot' . $model->video_path))) {
                unlink(Yii::getAlias('@webroot' . $model->video_path));
            }

            if ($model->delete()) {
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Lección eliminada exitosamente.');
            } else {
                throw new \Exception('No se pudo eliminar la lección.');
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', $e->getMessage());
            Yii::error($e->getMessage());
        }

        return $this->redirect(['index']);
    }

    protected function findModel($lesson_id)
    {
        if (($model = Lessons::findOne($lesson_id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La lección solicitada no existe.');
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