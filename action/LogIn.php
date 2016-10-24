<?php
/**
 * Date: 20.02.2016
 * Time: 19:52
 */

namespace mihaildev\user\action;


use mihaildev\user\forms\LoginForm;
use yii\base\Action;
use Yii;

class LogIn extends Action
{
    public $template = '';
    public $defaultUrl = null;

    public function run(){
        if (!\Yii::$app->user->isGuest) {
            return $this->controller->goHome();
        }

        if(empty($this->template))
            $this->template = '@mihaildev/user/views/login.php';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->controller->goBack($this->defaultUrl);
        } else {
            return $this->controller->render($this->template, [
                'model' => $model,
            ]);
        }
    }
}