<?php

namespace backend\controllers;

use backend\models\CategoriesProject;
use backend\models\CategoryProject;
use backend\models\Projects;
use backend\models\Technology;
use backend\models\TechnologyProjects;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProjectController extends Controller {
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
            3 => 'status ASC',
            4 => 'status DESC',
        ];
        $query = Projects::find();
        if (isset($list[$sort])) {
            $query->orderby($list[$sort]);
        } else {
            $query->orderby('id DESC');
        }
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 20]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['models' => $models, 'pages' => $pages]);
    }

    public function actionCreate() {
        $model = new Projects;
        $model->scenario = 'create';
        $model->ii = TRUE;
        $model->created_at = time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $category = CategoriesProject::findAll($model->category);
            foreach ($category as $item) {
                $category_project = new CategoryProject;
                $category_project->project = $model->id;
                $category_project->category = $item->id;
                $category_project->save();
            }
            $tech = Technology::findAll($model->tech);
            foreach ($tech as $item) {
                $tech_pro = new TechnologyProjects;
                $tech_pro->project = $model->id;
                $tech_pro->technology = $item->id;
                $tech_pro->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionView($id) {
        $model = Projects::findById($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionEdit($id) {
        $model = Projects::findById($id);
        $model->oldImage = $model->image;
        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->image)) {
                $model->ii = TRUE;
            }
            if ($model->validate()) {
                foreach ($model->categoriesId as $item) {
                    if (!in_array($item, $model->category)) {
                        CategoryProject::findOne(['project' => $model->id, 'category' => $item])->delete();
                    }
                }
                foreach ($model->techId as $item) {
                    if (!in_array($item, $model->tech)) {
                        TechnologyProjects::findOne(['project' => $model->id, 'technology' => $item])->delete();
                    }
                }
                foreach ($model->category as $item) {
                    $category = CategoriesProject::findId($item);
                    Yii::$app->db->createCommand("INSERT IGNORE INTO `miv_category_project` (`project`, `category`) VALUES ('$model->id', '$category->id')")->execute();
                }
                foreach ($model->tech as $item) {
                    $technology = Technology::findById($item);
                    Yii::$app->db->createCommand("INSERT IGNORE INTO `miv_technology_projects` (`project`, `technology`) VALUES ('$model->id', '$technology->id')")->execute();
                }
                $model->save();
                Yii::$app->session->setFlash('success', 'تغییرات با موفقیت ثبت شدن.');

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->category = $model->categoriesId;
            $model->tech = $model->techId;
        }

        return $this->render('edit', ['model' => $model]);
    }

    public function actionDelete($id) {
        $model = Projects::findById($id);
        $model->status = Projects::STATUS_DELETED;
        $model->oldImage = $model->image;
        $model->category = 1;
        $model->tech = 1;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'با موفقیت حذف شد.');
        } else {
            Yii::$app->session->setFlash('danger', 'با موفقیت حذف نشد دوباره تلاش کنید.');
        }

        return $this->redirect(['index']);
    }

    public function actionFulldelete($id) {
        $project = Projects::findById($id);
        $path = Yii::getAlias('@frontend/web/photos/');
        unlink($path . $project->image);
        unlink($path . 'temp-' . $project->image);
        if ($project->delete()) {
            Yii::$app->session->setFlash('success', 'با موفقیت حذف شد.');
        } else {
            Yii::$app->session->setFlash('danger', 'خطا:با موفقیت حذف نشد. دوباره تلاش کنید.');
        }

        return $this->redirect(['index']);
    }

    public function actionReturn($id, $status) {
        $list = [
            Projects::STATUS_ACTIVE,
            Projects::STATUS_DELETED,
        ];
        if (!in_array($status, $list)) {
            throw new NotFoundHttpException('پیدا نشد!');
        }
        $model = Projects::findById($id);
        $model->status = $status;
        $model->oldImage = $model->image;
        $model->category = 1;
        $model->tech = 1;
        $model->save();

        return $this->redirect(['projectdelete']);
    }

    public function actionSearch($id, $customer_name, $customer_email, $phone_mobile, $phone_static, $total_amount, $prepayment, $status, $name_project) {
        $query = Projects::find()->andFilterWhere(['id' => $id])->andFilterWhere([
                'like',
                'customer_name',
                $customer_name
            ])->andFilterWhere(['like', 'customer_email', $customer_email])->andFilterWhere([
                'like',
                'phone_mobile',
                $phone_mobile
            ])->andFilterWhere(['like', 'phone_static', $phone_static])->andFilterWhere([
                'like',
                'total_amount',
                $total_amount
            ])->andFilterWhere([
                'like',
                'prepayment',
                $prepayment
            ])->andFilterWhere(['status' => $status])->andFilterWhere(['like', 'name_project', $name_project]);
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 20]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->orderby('id DESC')->all();

        return $this->render('search', ['models' => $models, 'pages' => $pages]);
    }

    public function actionDsearch($id, $customer_name, $customer_email, $phone_mobile, $phone_static, $total_amount, $prepayment, $name_project) {
        $query = Projects::find()->andFilterWhere(['id' => $id])->andFilterWhere([
                'like',
                'customer_name',
                $customer_name
            ])->andFilterWhere(['like', 'customer_email', $customer_email])->andFilterWhere([
                'like',
                'phone_mobile',
                $phone_mobile
            ])->andFilterWhere(['like', 'phone_static', $phone_static])->andFilterWhere([
                'like',
                'total_amount',
                $total_amount
            ])->andFilterWhere(['like', 'prepayment', $prepayment])->andFilterWhere([
                'like',
                'name_project',
                $name_project
            ])->andWhere(['status' => Projects::STATUS_DELETED]);
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 20]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->orderby('id DESC')->all();

        return $this->render('project_delete', ['models' => $models, 'pages' => $pages]);
    }
}
