<?php
/**
 * Date: 09.02.2016
 * Time: 1:08
 */

namespace mihaildev\user\models;


use mihaildev\user\Component;
use yii\base\ErrorException;
use yii\base\Object;
use yii\web\IdentityInterface;

class User extends Object implements IdentityInterface
{
    public $id;
    public $username;
    public $password;

    /**
     * @return Component
     */
    public static function getComponent(){
        return \Yii::$app->user;
    }

    public static function getList(){
        return self::getComponent()->userList;
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return isset(self::getList()[$id]) ? new static(self::getList()[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new ErrorException('Function is disabled');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::getList() as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return md5(self::getComponent()->authKeySalt.$this->id);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}