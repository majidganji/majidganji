<?php

namespace backend\controllers;

use Yii;
use backend\models\Admin;
use backend\models\ResetPassword;
use yii\filters\AccessControl;
use yii\web\Controller;

class SettingController extends Controller
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

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionChangeprofile(){
        $model = Admin::findOne(Yii::$app->user->getId());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'با موفقیت تغییرات ذخیره شد.');
            return $this->redirect(['index']);
        }
        return $this->render('changeprofile', [
            'model' => $model
        ]);
    }

    public function actionChangepassword(){
        $model = new ResetPassword();
        if ($model->load(Yii::$app->request->post()) && $model->ok()) {
            Yii::$app->user->logout();
            return $this->goHome();
        }

        return $this->render('changepassword', [
            'model' => $model
        ]);
    }

    public function actionClear_cache() {
        Yii::$app->cache->flush();
        Yii::$app->session->setFlash('success', 'cache پاک شد.');
        return $this->redirect(Yii::$app->request->referrer);
    }
}
