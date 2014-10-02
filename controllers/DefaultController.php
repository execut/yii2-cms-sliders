<?php

namespace infoweb\sliders\controllers;

use Yii;
use infoweb\sliders\models\Slider;
use infoweb\sliders\models\SearchSlider;
use infoweb\sliders\models\SearchSliderImage;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * SliderController implements the CRUD actions for Slider model.
 */
class DefaultController extends Controller
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
        $searchModel = new SearchSlider();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $gridView = [
            'id' => 'gridview',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => '\kartik\grid\CheckboxColumn',
                    'options' => ['class' => 'test']
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => function ($model) {
                            return Html::a(Html::encode($model->name), Url::toRoute([
                                'update', 'id' => $model->id
                            ]), [
                                'title' => Yii::t('app', 'Update'),
                                'data-pjax' => '0',
                                'data-toggle' => 'tooltip',
                                'class' => 'edit-model',
                            ]);
                        },
                ],
                'width',
                'height',
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{update} {delete} {images}',
                    'buttons' => [
                        'images' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-picture"></span>', $url, [
                                'title' => Yii::t('app', Yii::t('app', 'Images')),
                                'data-pjax' => '0',
                                'data-toggle' => 'tooltip',
                            ]);
                        },
                    ],
                    'urlCreator' => function($action, $model, $key, $index) {

                        if ($action == 'images')
                        {
                            $params = is_array($key) ? $key : ['sliderId' => (int) $key];
                            $params[0] = $action . '/index';
                        } else {
                            $params = is_array($key) ? $key : ['id' => (int) $key];
                            $params[0] = 'default' . '/' . $action;
                        }

                        return Url::toRoute($params);
                    },
                    'updateOptions'=>['title' => Yii::t('app', 'Update'), 'data-toggle' => 'tooltip'],
                    'deleteOptions'=>['title' => Yii::t('app', 'Delete'), 'data-toggle' => 'tooltip'],
                    'width' => '100px',
                ],
            ],
            'responsive' => true,
            'floatHeader' => true,
            'floatHeaderOptions' => ['scrollingTop' => 88],
            'hover' => true,
        ];

        return $this->render('index', [
            'gridView' => $gridView,
        ]);
    }

    /**
     * Displays a single Slider model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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

        $post = Yii::$app->request->post();

        if (Yii::$app->request->isAjax && $model->load($post)) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);

        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Set flash message
            Yii::$app->session->setFlash('slider-success', Yii::t('app', "{modelClass} {modelName} successfully created", ['modelClass' => 'Slider', 'modelName' => $model->name]));

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
            Yii::$app->session->setFlash('slider-success', Yii::t('app', "{modelClass} {modelName} successfully updated", ['modelClass' => 'Slider', 'modelName' => $model->name]));

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
            // @todo Show flash message (with javascript?)
            //Yii::$app->session->setFlash('slider-success', Yii::t('app', '{n, plural, =1{# slider} other{# sliders}} successfully deleted', ['n' => count($ids)]));
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
