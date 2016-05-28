<?php

namespace App\Validators;

class UsersValidator extends BaseValidator
{

    protected function postRegister()
    {
        return $this->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:8',
            'numphone' => 'required',
            'gender' => 'integer',
        ]);
    }

    protected function store()
    {
        return $this->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:8',
            'numphone' => 'required',
            'gender' => 'integer',
        ]);
    }

    protected function update()
    {
        return $this->validate([
            'email' => 'required_without_all:name,password,numphone,sex|unique:users,email,' . $this->route->parameter('users')->id,
            'name' => 'required_without_all:email,password,numphone,sex',
            'password' => 'required_without_all:email,name,numphone,sex|min:8',
            'numphone' => 'required_without_all:email,name,password,sex',
            'gender' => 'required_without_all:email,name,password,numphone',
        ]);
    }
}
