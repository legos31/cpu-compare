<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Languages;
use app\modules\admin\models\PageLanguage;
use Yii;
use app\modules\admin\models\Pages;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pages::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
		// echo '<pre>';
		// print_r(Yii::$app->request); die;
		// echo '</pre>';
        $page = $this->findModel($id);
        $languages = Languages::find()->all();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            foreach ($languages as $language) {
                $model = PageLanguage::find()->where(['page_id' => $id, 'language_id' => $language->id])->one();
                if(!$model){
                    $model = new PageLanguage();
                    $model->page_id = $id;
                    $model->language_id = $language->id;
                }
                $model->title = $post['meta'][$language->code]['title'];
                $model->description = $post['meta'][$language->code]['description'];
                $model->card_description = $post['meta'][$language->code]['card_description'];
                $model->save();
            }
            return $this->redirect(['index']);
        }

        $meta = [];
        foreach ($languages as $language) {
            $data = PageLanguage::find()->where(['page_id' => $id, 'language_id' => $language->id])->one();
            $meta[$language->id] = [
                'title' => $data->title ?? '',
                'description' => $data->description ?? '',
                'card_description' => $data->card_description ?? '',
            ];
        }

        return $this->render('update', [
            'page' => $page,
            'languages' => $languages,
            'meta' => $meta,
        ]);
    }

    /**
     * Deletes an existing Pages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
