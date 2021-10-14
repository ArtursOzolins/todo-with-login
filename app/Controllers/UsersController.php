<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\MysqlUserRepository;
use App\Repositories\UserRepository;

class UsersController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new MysqlUserRepository();
    }

    public function index()
    {
        unset($_SESSION['user']);
        require_once 'app/Views/Users/AppView.php';
    }

    public function registrationForm()
    {
        require_once 'app/Views/Users/RegistrationView.php';
    }

    public function loginForm()
    {
        require_once 'app/Views/Users/LoginView.php';
    }

    public function loginValidate()
    {
        $user = $this->userRepository->getOne($_POST['name']);
        if ($user === null)
        {
            require_once 'app/Views/Users/FailedNameView.php';
        } else if (password_verify($_POST['password'], $user->getPassword()) === false)
        {
            require_once 'app/Views/Users/FailedPasswordView.php';;
        } else {
            $_SESSION['user'] = $_POST['name'];
            header('Location: /tasks');
        }
    }

    public function register()
    {
        $this->userRepository->registrate(new User($_POST['name'], password_hash($_POST['password'],PASSWORD_DEFAULT)));
        header('Location: /');
    }
}
