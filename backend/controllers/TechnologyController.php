<?php

namespace backend\controllers;

use backend\models\Technology;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;

class TechnologyController extends \yii\web\Controller
{
    public $layout = 'site';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex($sort = null)
    {
        $list = [
            1 => 'id ASC',
            2 => 'id DESC',
            3 => 'name ASC',
            4 => 'name DESC',
        ];
        $query = Technology::find();
        if (isset($list[$sort])) {
            $query->orderby($list[$sort]);
        }
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 20]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    public function actionSearch($id, $name)
    {
        $query = Technology::find()->andFilterWhere(['like', 'id', $id])->andFilterWhere(['like', 'LOWER(name)', strtolower($name)]);
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 20]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->orderby('id DESC')->all();
        return $this->render('search', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    public function actionCreate()
    {
        $model = new Technology;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionView($id)
    {
        $model = Technology::findById($id);
        return $this->render('view', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        Technology::findById($id)->delete();
        Yii::$app->session->setflash('success', 'با وفقیت حذف شد.');
        return $this->redirect(['index']);
    }

    public function actionEdit($id)
    {
        $model = Technology::findById($id);
        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

}
