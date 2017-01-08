<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 11/16/16
 * Time: 10:47 PM
 */

namespace frontend\controllers;

use yii\web\Controller;

class ErrorController extends Controller {

    public $layout = 'error';

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}