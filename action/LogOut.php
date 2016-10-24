<?php
/**
 * Date: 20.02.2016
 * Time: 21:21
 */

namespace mihaildev\user\action;


use yii\base\Action;

class LogOut extends Action
{
    public function run(){
        if(!\Yii::$app->user->isGuest)
            \Yii::$app->user->logout();

        return $this->controller->goHome();
    }
}