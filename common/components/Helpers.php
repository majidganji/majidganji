<?php
namespace common\components;


use backend\models\Articles;
use yii\base\Component;
use Yii;

class Helpers extends Component {

    public function shortText($text) {
        $len = strpos($text, '<!-- pagebreak -->');
       if (empty($len)){
           return $text;
       }
        return substr($text, 0, $len);
    }

    public function archive() {
        $posts = Articles::find()->where(['status' => 10])->select('created_at')->orderBy('id DESC')->all();
        $months = [];
        foreach ($posts as $post){
            $month = Yii::$app->jdf->jdate('F y', $post->created_at);
            if (!isset($months[$month])){
                $months[$month] = ['count' => 1, 'url' => date('Y-m', $post->created_at)];
            }else{
                $months[$month]['count']++;
            }
        }
        return $months;
    }
}