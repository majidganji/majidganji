<?php

namespace backend\controllers;

use Yii;
use backend\models\Comment;
use backend\models\CommentSearch;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CommentController extends Controller {

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
                ],
            ],
        ];
    }

    public function actionIndex() {
        $query = Comment::find()->orderBy('id desc');
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Comment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id) {
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', 'با موفقیت حذف شد.');

            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('danger', 'خطا، دوباره تلاش کنید.');

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAnswer(){
        $parent_id = Yii::$app->security->validateData(Yii::$app->request->post('parent'), 'uashdn/*ada5d1');
        $body = Yii::$app->request->post('body');
        $status = Yii::$app->request->post('status');
        $comment = $this->findModel($parent_id);

        $model = new Comment();
        $model->parent_id = $comment->id;
        $model->post_id = $comment->post_id;
        $model->name = Yii::$app->user->identity->username;
        $model->email = Yii::$app->user->identity->email;
        $model->body = $body;
        $model->ts = time();
        $model->status = $status == 10 ? 10 : 0;
        $model->website = Url::base(true);

        if ($model->save()){
            Yii::$app->session->setFlash('success', 'با موفقیت درج شد.');
        }else{
            Yii::$app->session->setFlash('danger', 'خطا دوباره تلاش کنید.');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModel($id) {
        if (($model = Comment::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('صفحه مورد نظر پیدا نشد.');
        }
    }

    public function actionSearch($id, $post, $name, $parent, $status){
        $query = Comment::find();
        $query->joinWith('post');
        $query->andFilterWhere(['like', 'id', $id])
            ->andFilterWhere(['like', 'LOWER(miv_articles.title)', strtolower($post)])
            ->andFilterWhere(['like', 'LOWER(name)', strtolower($name)])
            ->andFilterWhere(['like', 'parent_id', $parent])
            ->andFilterWhere(['status' => $status]);

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 20,
        ]);

        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages
        ]);
    }
}
