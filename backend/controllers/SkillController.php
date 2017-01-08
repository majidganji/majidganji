<?php

namespace backend\controllers;

use backend\models\Skills;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SkillController extends Controller {

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

    public function actionIndex() {
        $models = Skills::find()->orderby('id DESC')->all();

        return $this->render('index', ['models' => $models]);
    }

    public function actionCreate() {
        $model= new Skills();

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', 'با موفقیت درج شد.');
            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionDelete($id) {
        if ($this->findById($id)->delete()){
            Yii::$app->session->setFlash('success', 'با موفقیت حذف شد.');
        }else{
            Yii::$app->session->setFlash('danger', 'خطا، لطفا دوباره تلاش کنید.');
        }

        return $this->redirect(['index']);
    }

    public function actionEdit($id) {
        $model = $this->findById($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', 'با موفقیت انجام شد.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', ['model' => $model]);
    }

    public function actionSearch($id, $name) {
        $models = Skills::find()->andFilterWhere(['like', 'id', $id])
            ->andFilterWhere(['like', 'LOWER(name)', $name])->orderBy('id desc')->all();

        return $this->render('search', ['models' => $models]);
    }

    private function findById($id){
        if ($model = Skills::findOne($id)){
            return $model;
        }
        throw new NotFoundHttpException('مهارت مورد نظر یافت نشد.');
    }
}
