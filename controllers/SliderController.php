<?php

namespace infoweb\sliders\controllers;

use Yii;
use infoweb\sliders\models\Slider;
use infoweb\sliders\models\SliderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * SliderController implements the CRUD actions for Slider model.
 */
class SliderController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Slider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SliderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Slider model.
     * If creation is successful, the browser will be redirected to the 'index', 'create', or 'update' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Slider();
        $model->loadDefaultValues();
        
        // Set default values
        $model->width = $this->module->defaultWith;
        $model->height = $this->module->defaultHeigth;

        $post = Yii::$app->request->post();

        if (Yii::$app->request->isAjax && $model->load($post)) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);

        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Set flash message
            Yii::$app->session->setFlash('slider-success', Yii::t('app', "{item} successfully created", ['item' => $model->name]));

            if (isset($post['close'])) {
                return $this->redirect(['index']);
            } elseif (isset($post['new'])) {
                return $this->redirect(['create']);
            } else {
                return $this->redirect(['update', 'id' => $model->id]);
            }

        } else {

            return $this->render('create', [
                'model' => $model,
            ]);

        }
    }

    /**
     * Updates an existing Slider model.
     * If update is successful, the browser will be redirected to the 'index', 'create' or 'update' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();

        if (Yii::$app->request->isAjax && $model->load($post)) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);

        } elseif ($model->load($post) && $model->save()) {

            // Set flash message
            Yii::$app->session->setFlash('slider-success', Yii::t('app', "{item} successfully updated", ['item' => $model->name]));

            if (isset($post['close'])) {
                return $this->redirect(['index']);
            } elseif (isset($post['new'])) {
                return $this->redirect(['create']);
            } else {
                return $this->redirect(['update', 'id' => $model->id]);
            }

        } else {

            return $this->render('update', [
                'model' => $model,
            ]);

        }
    }

    /**
     * Deletes an existing Slider model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Deletes existing Slider models.
     * If deletion is successful, the gridview will be refreshed.
     * @param string $id
     * @return mixed
     */
    public function actionMultipleDelete()
    {
        // @todo $ids as param in action?

        $data['status'] = 0;
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax) {

            $ids = Yii::$app->request->post('ids');

            Slider::deleteAll(['id' => $ids]);

            // Set flash message
            $data['message'] = Yii::t('app', '{n, plural, =1{Slider} other{# sliders}} successfully deleted', ['n' => count($ids)]);
            $data['status'] = 1;
        }

        return $data;
    }

    public function actionMultipleDeleteConfirmMessage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $message = Yii::t('app', 'Are you sure you want to delete {n, plural, =1{this slider} other{# sliders}}?', ['n' => Yii::$app->request->post('ids')]);
        return $message;
    }

    /**
     * Finds the Slider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Slider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slider::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested item does not exist'));
        }
    }
}
