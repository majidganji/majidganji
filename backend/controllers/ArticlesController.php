<?php

namespace backend\controllers;


use backend\models\Articles;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class ArticlesController extends Controller {

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

    public function actionCreate() {
        $model = new Articles();
        $model->scenario = 'create';
        $model->editor_id = Yii::$app->user->identity->getId();
        $model->created_at = time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'مطلب جدید با موفقیت ثبت شد.');

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionIndex($sort = NULL) {
        $list = [
            1 => 'id ASC',
            2 => 'id DESC',
            3 => 'title asc',
            4 => 'title desc',
        ];

        $query = Articles::find();
        if (isset($list[$sort])) {
            $query->orderBy($list[$sort]);
        }

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 20,
        ]);

        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['models' => $models, 'pages' => $pages]);
    }

    public function actionView($id) {
        $model = $this->findModel($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionEdit($id) {
        $model = $this->findModel($id);
        $model->oldImage = $model->image;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'با موفقیت حذف شد.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('edit', ['model' => $model]);
    }

    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', 'با موفقیت حذف شد.');

            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('danger', 'خطا، لطفا دوباره تلاش کنید.');

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionSearch($id, $title, $editor, $category, $status) {
        $query = Articles::find()->joinWith('editor')
            ->andFilterWhere(['like', 'id', $id])
            ->andFilterWhere(['like', 'title', $title])
            ->andFilterWhere(['like', 'miv_admin.username', $editor])
            ->andFilterWhere(['category_id' => $category])
            ->andFilterWhere(['miv_articles.status' => $status]);

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 20,
        ]);

        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', ['models' => $models, 'pages' => $pages]);
    }

    private function findModel($id) {
        if ($model = Articles::findOne($id)) {
            return $model;
        }
        throw  new  NotFoundHttpException('مطلب مورد نظر پیدا نشد.');
    }
}