Простая компонента для настройки работы с доступом
===========================

Простая авторизация для сайта

## Установка и Настройка
1) добавляем в composer.json - "mihaildev/yii2-user": "*"
2) замена стандартной компоненты

```php

'components' => [
        'user' => [
            'class' => 'mihaildev\user\Component',
            'enableAutoLogin' => true,
            'loginUrl' => ['/site/login'], //'loginUrl' => ['/user/login'],
            'userList' => [
                '1' => [// id value
                  'id' => '1',
                  'username' => 'admin',
                  'password' => 'admin',
                ]
            ],
            'authKeySalt' => 'SomeSecreteValue'
        ],

```

3) добавление в контроллер действий

```php
class SiteController extends Controller
{
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
                //'template' => 'login' // default: @mihaildev/user/views/login.php,
                //'defaultUrl' => ['/site/index'],

            ],
            'logout' => 'mihaildev\user\action\LogOut',
        ];
    }
```

или добавляем контроллер mihaildev\user\Controller

```php

'controllerMap' => [
        'user' => [
            'class' => 'mihaildev\user\Controller',
            //'template' => 'login' // default: @mihaildev/user/views/login.php,
            //'defaultUrl' => ['/site/index'],
        ]

```

