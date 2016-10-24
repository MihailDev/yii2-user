<?php
/**
 * Date: 24.10.2016
 * Time: 3:14
 */

namespace mihaildev\user;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class Controller extends \yii\web\Controller
{
    public $template = '';
    public $defaultUrl = null;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
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

    public function actions()
    {
        return [
            'login' => [
                'class' => 'mihaildev\user\action\LogIn',
                'template' => $this->template,
                'defaultUrl' => $this->defaultUrl
            ],
            'logout' => 'mihaildev\user\action\LogOut',
        ];
    }
}