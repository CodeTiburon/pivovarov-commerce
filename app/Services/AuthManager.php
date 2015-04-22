<?php namespace App\Services;

use Illuminate\Auth\AuthManager as AuthManagerBase;

class AuthManager extends AuthManagerBase {

    public function checkAdmin()
    {
        if ($this->check()) {

            if ($this->user()->role = 'admin'){
                echo 'ТЫ АДМИН'; die;
            }

        }
    }

}