<?php

namespace app\modules\admin\controllers;

use app\models\Brand;
use app\modules\admin\models\Benchmark;
use app\modules\admin\models\CardBenchmark;
use app\modules\admin\models\CardBenchmarkItems;
use app\modules\admin\models\CardSpecification;
use app\modules\admin\models\CardSpecificationItems;
use app\modules\admin\models\Gpu;
use app\modules\admin\models\Specification;
use Yii;
use app\modules\admin\models\Card;
use app\modules\admin\models\CardSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CardController implements the CRUD actions for Card model.
 */
class CardController extends Controller
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
     * Lists all Card models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $ids = Card::find()->select('brand_id')->column();
        $ids = array_unique($ids);
        $brands = ArrayHelper::map(Brand::findAll($ids), 'id', 'name');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'brands' => $brands,
        ]);
    }

    /**
     * Displays a single Card model.
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
     * Creates a new Card model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Card();

        $list = Specification::find()->all();
        $specifications = [];
        foreach ($list as $item) {
            $specifications[] = [
                'id' => $item->id,
                'text' => $item->name
            ];
        }


        $list2 = Benchmark::find()->all();
        $benchmarks = [];
        foreach ($list2 as $item) {
            $benchmarks[] = [
                'id' => $item->id,
                'text' => $item->name
            ];
        }
        $brands = ArrayHelper::map(Brand::find()->all(), 'id', 'name');

        if(Yii::$app->request->isPost){
//            dump(Yii::$app->request->post());
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file_mini = UploadedFile::getInstance($model, 'file_mini');
            $model->upload();
            $model->saveSpecifications();
            $model->saveBenchmark();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'brands' => $brands,
            'specifications' => $specifications,
            'benchmarks' => $benchmarks,
        ]);
    }

    /**
     * Updates an existing Card model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $list = Specification::find()->all();
        $specifications = [];
        foreach ($list as $item) {
            $specifications[] = [
                'id' => $item->id,
                'text' => $item->name
            ];
        }


        $list2 = Benchmark::find()->all();
        $benchmarks = [];
        foreach ($list2 as $item) {
            $benchmarks[] = [
                'id' => $item->id,
                'text' => $item->name
            ];
        }
        $brands = ArrayHelper::map(Brand::find()->all(), 'id', 'name');

        if(Yii::$app->request->isPost){
//            dump(Yii::$app->request->post());
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file_mini = UploadedFile::getInstance($model, 'file_mini');
            $model->upload();
            $model->saveSpecifications();
            $model->saveBenchmark();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'brands' => $brands,
            'specifications' => $specifications,
            'benchmarks' => $benchmarks,
        ]);
    }

    /**
     * Deletes an existing Card model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $b = CardBenchmark::find()->where(['card_id' => $id])->all();
        foreach ($b as $item) {
            CardBenchmarkItems::deleteAll(['card_benchmark_id' => $item->id]);
            $item->delete();
        }

        $b = CardSpecification::find()->where(['card_id' => $id])->all();
        foreach ($b as $item) {
            CardSpecificationItems::deleteAll(['card_specification_id' => $item->id]);
            $item->delete();
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Card model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Card the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Card::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
