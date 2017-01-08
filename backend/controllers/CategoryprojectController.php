<?php

namespace backend\controllers;

use backend\models\CategoriesProject;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;

class CategoryprojectController extends Controller {

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

    public function actionIndex($sort = NULL) {
        $list = [
            1 => 'id ASC',
            2 => 'id DESC',
            3 => 'name ASC',
            4 => 'name DESC',
        ];
        $query = CategoriesProject::find();
        if (isset($list[$sort])) {
            $query->orderby($list[$sort]);
        } else {
            $query->orderby($list[2]);
        }
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 20]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['models' => $models, 'pages' => $pages]);
    }

    public function actionCreate() {
        $model = new CategoriesProject;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionView($id) {
        $model = CategoriesProject::findId($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionDelete($id) {
        CategoriesProject::findId($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionEdit($id) {
        $model = CategoriesProject::findId($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('edit', ['model' => $model]);
    }

    public function actionSearch($id, $name, $slug) {
        $query = CategoriesProject::find();
        $query->andFilterWhere(['like', 'id', $id])->andFilterWhere([
            'like',
            'LOWER(name)',
            strtolower($name)
        ])->andFilterWhere(['like', 'LOWER(slug)', strtolower($slug)]);
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 20]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', ['models' => $models, 'pages' => $pages]);
    }
}
