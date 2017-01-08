<?php
namespace frontend\controllers;

use backend\models\Articles;
use backend\models\Categories;
use frontend\models\Comment;
use backend\models\Projects;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller {

    public $layout = 'menu-content';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => TRUE,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => TRUE,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM miv_articles',
                ],
            ],
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['work'],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM miv_projects',
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'KSNdjasd' : NULL,
            ],
        ];
    }

    public function actionIndex() {
        $query = Articles::find()->where(['status' => 10])->orderBy('id DESC');
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 5,
        ]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['models' => $models, 'pages' => $pages]);
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'باتشکر، در اسرع وقت به شما پاسخ خواهم داد.');
            } else {
                Yii::$app->session->setFlash('error', 'خطایی در ارسال ایمیل وجود دارد.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbute() {
        return $this->render('rozme');
    }

    public function actionWork() {
        $query = Projects::find()->where(['status' => Projects::STATUS_ACTIVE])->orderBy('id DESC');
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 5
        ]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('work', [
            'models' => $models,
            'pages' => $pages
        ]);
    }

    public function actionWorkshow($slug) {
        $model = Projects::find()->where(['slug' => $slug, 'status' => Projects::STATUS_ACTIVE])->one();

        return $this->render('work_show', [
            'model' => $model
        ]);
    }

    public function actionPost($slug) {
        if (!($model = Articles::findOne(['slug' => $slug, 'status' => 10]))){
            throw new NotFoundHttpException('مطلب مورد نظر پیدا نشد.');
        }

        return $this->render('post', ['model' => $model]);
    }

    public function actionCategory($slug) {
        if (!($category = Categories::find()->where(['slug' => $slug])->select(['name', 'id'])->one())){
            throw new NotFoundHttpException('دسته بندی مورد نظر پیدا نشد.');
        }
        $query = Articles::find()->where(['status' => 10, 'category_id' => $category->id])->orderBy('id DESC');
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 5,
        ]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('category', ['category' => $category, 'models' => $models, 'pages' => $pages]);
    }

    public function actionArchive($month) {
        list($year, $month) = explode('-', $month);
        $startTS = mktime(0, 0, 0, $month, 0, $year);
        $month++;
        if ($month > 12) {
            $month = 0;
            $year++;
        }
        $endTS = mktime(0, 0, 0, $month, 0, $year);

        $query = Articles::find()->where(['status' => 10])->andWhere(['>=' , 'created_at', $startTS])->andWhere(['<', 'created_at', $endTS])->orderBy('id DESC');
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 5,
        ]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', ['models' => $models, 'pages' => $pages]);
    }

    public function actionSearch($search) {
        $query = Articles::find()->orderBy('id DESC')->where(['like', 'title', $search]);

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 5,
        ]);

        $models= $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', ['models' => $models, 'pages' => $pages, 'search' => $search]);
    }

    public function actionInsertcomment() {
        $model = new Comment();
        $model->post_id = (Yii::$app->security->validateData(Yii::$app->request->post('post'), 'hsdvjadhsda'));
        $model->ts = time();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            echo '<div class="alert alert-success">با تشکر، نظر شما با موفقیت ثبت شد.</div>';
        }else{
            echo '<div class="alert alert-danger">خطا:‌لطفا بعد از بار گزاری مجدد صفحه دوباره تلاش کنید.</div>';
        }
    }
}
