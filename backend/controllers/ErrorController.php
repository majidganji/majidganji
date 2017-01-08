<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 11/17/16
 * Time: 9:32 PM
 */

namespace backend\controllers;


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