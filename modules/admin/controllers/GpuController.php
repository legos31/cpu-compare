<?php

namespace app\modules\admin\controllers;

use app\models\Brand;
use app\modules\admin\models\Benchmark;
use app\modules\admin\models\Card;
use app\modules\admin\models\GpuBenchmark;
use app\modules\admin\models\GpuBenchmarkItems;
use app\modules\admin\models\GpuSpecification;
use app\modules\admin\models\GpuSpecificationItems;
use app\modules\admin\models\Specification;
use Yii;
use app\modules\admin\models\Gpu;
use app\modules\admin\models\GpuSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GpuController implements the CRUD actions for Gpu model.
 */
class GpuController extends Controller
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
     * Lists all Gpu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GpuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $ids = Gpu::find()->select('brand_id')->column();
        $ids = array_unique($ids);
        $brands = ArrayHelper::map(Brand::findAll($ids), 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'brands' => $brands,
        ]);
    }

    /**
     * Displays a single Gpu model.
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
     * Creates a new Gpu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gpu();
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
     * Updates an existing Gpu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $brands = ArrayHelper::map(Brand::find()->all(), 'id', 'name');

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
     * Deletes an existing Gpu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $b = GpuBenchmark::find()->where(['gpu_id' => $id])->all();
        foreach ($b as $item) {
            GpuBenchmarkItems::deleteAll(['gpu_benchmark_id' => $item->id]);
            $item->delete();
        }

        $b = GpuSpecification::find()->where(['gpu_id' => $id])->all();
        foreach ($b as $item) {
            GpuSpecificationItems::deleteAll(['gpu_specification_id' => $item->id]);
            $item->delete();
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gpu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gpu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gpu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
