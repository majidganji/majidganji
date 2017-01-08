<?php
namespace backend\controllers;

use common\models\AdminLoginForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'error'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => TRUE,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
        ];
    }

    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : NULL,
                'height' => 40
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        $data = Yii::$app->cache->get('times-login');
        if ($data > 5) {
            $model->addError('password', 'بیش از 5 بار اشتباه شده، یک دقیقه صبر کنید.');

            return $this->render('login', [
                'model' => $model,
            ]);
        }
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->cache->set('times-login', $data + 1, 60);
            if ($model->login()) {
                return $this->goBack();
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
