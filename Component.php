<?php
/**
 * Date: 24.10.2016
 * Time: 2:12
 */

namespace mihaildev\user;


use yii\web\User;

class Component extends User
{
    public $identityClass = 'mihaildev\user\models\User';
    public $rememberTime = 2592000; //month
    public $userList = [
        '1' => [// id value
            'id' => '1',
            'username' => 'admin',
            'password' => 'admin',
        ],
    ];
    public $authKeySalt = 'SomeSecreteValue';
}