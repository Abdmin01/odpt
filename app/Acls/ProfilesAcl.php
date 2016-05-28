<?php

namespace App\Acls;

use App\Profile;

class ProfilesAcl extends BaseAcl
{

    protected function show()
    {
        $profile = $this->route->parameter('profiles', new Profile);
        if ($this->user->id != $profile->user_id) {
            return false;
        }
        return true;
    }

    protected function update()
    {
        $task = $this->route->parameter('profiles', new Profile);
        if ($this->user->id != $profile->user_id) {
            return false;
        }
        return true;
    }

    protected function delete()
    {
        $task = $this->route->parameter('profiles', new Profile);
        if ($this->user->id != $profile->user_id) {
            return false;
        }
        return true;
    }
}
