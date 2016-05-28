<?php

namespace App\Validators;

class ProfilesValidator extends BaseValidator
{

    protected function store()
    {
        return $this->validate([
            'fullname' => 'required',
            'bdate' => 'required',
            'numphone' => 'required',
        ]);
    }

    protected function update()
    {
        return $this->validate([
            'fullname' => 'required_without_all:bdate,numphone',
            'bdate' => 'required_without_all:fullname,numphone',
            'numphone' => 'required_without_all:fullname,bdate',
        ]);
    }
}
