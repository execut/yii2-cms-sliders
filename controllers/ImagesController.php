<?php

namespace infoweb\sliders\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\base\model;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use rico\yii2images\controllers\ImagesController as BaseImagesController;
use infoweb\cms\models\Image;
use infoweb\cms\models\ImageSearch;
use infoweb\cms\models\ImageLang;
use infoweb\sliders\models\Slider;
use infoweb\cms\models\ImageUploadForm;

class ImagesController extends BaseImagesController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'active' => ['post'],
                    'upload' => ['post']
                ],
            ],
        ];
    }

    /**
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex()
    {
        // An option-set id is provided through the url so store it in a session variable
        if (Yii::$app->request->get('sliderId'))
            Yii::$app->session->set('slider.sliderId', Yii::$app->request->get('sliderId'));

        $get = Yii::$app->request->get();

        $slider = Slider::findOne($get['sliderId']);

        $searchModel = new ImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $slider->id, Slider::className());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'slider' => $slider,
        ]);
    }

    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {

            $post = Yii::$app->request->post();

            $slider = Slider::findOne(Yii::$app->session->get('slider.sliderId'));

            $form = new ImageUploadForm;
            $images = UploadedFile::getInstances($form, 'images');

            foreach ($images as $k => $image) {

                $_model = new ImageUploadForm();
                $_model->image = $image;

                if ($_model->validate()) {
                    $path = \Yii::getAlias('@uploadsBasePath') . "/img/{$_model->image->baseName}.{$_model->image->extension}";

                    $_model->image->saveAs($path);

                    // Attach image to model
                    $slider->attachImage($path);

                } else {
                    foreach ($_model->getErrors('image') as $error) {
                        $slider->addError('image', $error);
                    }
                }
            }

            if ($form->hasErrors('image')) {
                // @todo Translate
                $response['message'] = count($form->getErrors('image')) . ' of ' . count($images) . ' images not uploaded';
            } else {
                $response['message'] = Yii::t('app', '{n, plural, =1{Image} other{# images}} successfully uploaded', [
                    'n' => count($images),
                ]);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return $response;

        }
    }

    /**
     * Updates an existing Image model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id, $sliderId)
    {
        $model = $this->findModel($id);

        $slider = Slider::findOne($sliderId);

        if (Yii::$app->request->getIsPost()) {

            $post = Yii::$app->request->post();

            // Ajax request, validate the models
            if (Yii::$app->request->isAjax) {

                // Populate the model with the POST data
                $model->load($post);

                // Create an array of translation models and populate them
                $translationModels = ArrayHelper::index($model->getTranslations()->all(), 'language');
                Model::loadMultiple($translationModels, $post);

                // Validate the model and translation
                $response = array_merge(
                    ActiveForm::validate($model),
                    ActiveForm::validateMultiple($translationModels)
                );

                // Return validation in JSON format
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $response;

                // Normal request, save models
            } else {
                // Wrap everything in a database transaction
                $transaction = Yii::$app->db->beginTransaction();

                // Validate the main model
                if (!$model->load($post)) {
                    return $this->render('update', [
                        'model' => $model,
                        'slider' => $slider,
                    ]);
                }

                // Add the translations
                foreach (Yii::$app->request->post(StringHelper::basename(ImageLang::className()), []) as $language => $data) {
                    foreach ($data as $attribute => $translation) {
                        $model->translate($language)->$attribute = $translation;
                    }
                }

                if (!$model->save()) {
                    return $this->render('update', [
                        'model' => $model,
                        'slider' => $slider,
                    ]);
                }

                $transaction->commit();

                // Set flash message
                Yii::$app->getSession()->setFlash('image-success', Yii::t('app', '"{item}" has been updated', ['item' => $model->name]));

                return $this->redirect(['index?sliderId=' . $slider->id]);
            }

        }
        return $this->render('update', [
            'model' => $model,
            'slider' => $slider,
        ]);
    }
    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id, $sliderId)
    {
        $model = $this->findModel($id);
        $model->delete();

        // Set flash message
        Yii::$app->getSession()->setFlash('image-success', Yii::t('app', '"{item}" has been deleted', ['item' => $model->name]));

        return $this->redirect(['index?sliderId=' . $sliderId]);
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

            Image::deleteAll(['id' => $ids]);

            $data['message'] = Yii::t('app', '{n, plural, =1{Image} other{# images}} successfully deleted', [
                'n' => count($ids),
            ]);
            $data['status'] = 1;
        }

        return $data;
    }

    public function actionMultipleDeleteConfirmMessage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $message = Yii::t('app', 'Are you sure you want to delete {n, plural, =1{this image} other{# images}}?', [
            'n' => Yii::$app->request->post('ids'),
        ]);
        return $message;
    }

    /**
     * Set active state
     * @param string $id
     * @return mixed
     */
    public function actionActive()
    {
        $model = $this->findModel(Yii::$app->request->post('id'));
        $model->active = ($model->active == 1) ? 0 : 1;

        return $model->save();
    }

    /**
     *
     *
     * @param string $id
     * @return mixed
     */
    public function actionSort($sliderId)
    {
        $slider = Slider::findOne($sliderId);

        $images = Image::find()->where(['itemId' => $slider->id, 'modelName' => 'Slider'])->orderBy(['position' => SORT_DESC])->all();

        return $this->render('sort', [
            'slider' => $slider,
            'images' => $images,
        ]);
    }

    public function actionSortPictures()
    {
        $data['status'] = 0;

        if (Yii::$app->request->isAjax) {

            // Get ids
            $post = Yii::$app->request->post();
            $ids = array_reverse($post['ids']);

            $sqlValues = [];

            // Update positions

            // Build values
            foreach ($ids as $position => $id) {
                $position++;
                $sqlValues[] = "({$id}, {$position})";
            }

            $sqlValues = implode(',', $sqlValues);

            // Execute query
            $connection = Yii::$app->db;
            $command = $connection->createCommand("
                INSERT INTO `image` (`id`,`position`) VALUES {$sqlValues}
                ON DUPLICATE KEY UPDATE `position` = VALUES(`position`)
            ");
            $command->execute();

            // Set responsse format
            Yii::$app->response->format = Response::FORMAT_JSON;

            // Success
            $data['message'] = Yii::t('app', 'The sorting was successfully updated');
            $data['status'] = 1;
        }

        return $data;

    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested item does not exist'));
        }
    }


}
