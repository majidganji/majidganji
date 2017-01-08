<?php
namespace backend\controllers;


use backend\models\Categories;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class CategoryarticlesController extends Controller {

    public $layout = 'site';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => TRUE,
                        'roles' => ['@'],
                    ],
                ]
            ],
        ];
    }

    public function actionIndex($sort = NULL) {
        $list = [
            '1' => 'id ASC',
            '2' => 'id DESC',
            '3' => 'name ASC',
            '4' => 'name DESC',
        ];
        $query = Categories::find();
        if (isset($list[$sort])) {
            $query->orderBy($list[$sort]);
        }
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 20,
        ]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    public function actionView($id) {
        $model = $this->findModel($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionEdit($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'با موفقیت ذخیره شد.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('edit', [
            'model' => $model
        ]);
    }

    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', 'با موفقیت حذف شد.');

            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('danger', 'خطا، لطفا دوباره تلاش کنید.');

        return $this->redirect(Yii::$app->request->referrer);

    }

    public function actionCreate() {
        $model = new Categories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'با موفقیت درج شد.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionSearch($id, $name, $slug) {
        $query = Categories::find()->andFilterWhere(['LIKE', 'id', $id])->andFilterWhere([
                'LIKE',
                'LOWER(`name`)',
                strtolower($name)
            ])->andFilterWhere(['LIKE', 'LOWER(‍‍‍‍‍‍‍`slug`)', strtolower($slug)]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 20
        ]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', ['models' => $models, 'pages' => $pages]);
    }

    private function findModel($id) {
        if ($model = Categories::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException('دسته بندی مورد نظر پیدا نشد.');
    }
}