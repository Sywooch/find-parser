<?php
namespace common\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $fio;
    public $email;
    public $phone;
    public $role;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот логин уже зарегистрирован на сайте'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['phone', 'filter', 'filter' => 'trim'],
            ['phone', 'required'],
            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот телефон уже зарегистрирован на сайте'],
            ['phone', 'string', 'min' => 2, 'max' => 255],

            ['fio', 'filter', 'filter' => 'trim'],
            ['fio', 'required'],
            ['fio', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Эта почта уже зарегистрирована на сайте'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'fio' => 'Ф.И.О.',
            'email' => 'Електронная почта',
            'phone' => 'Телефон',
            'password' => 'Пароль',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->fio = $this->fio;
            $user->email = $this->email;
            $user->phone = $this->phone;
            $user->role = 0;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Редактирование пользователя
     * @return null|static
     */
    public function update()
    {
        $user = User::findOne(Yii::$app->user->id);
        $user->username = $this->username;
        $user->fio = $this->fio;
        $user->email = $this->email;
        $user->phone = $this->phone;
        if ($user->update()) {
            return $user;
        }
        return null;
    }
}
