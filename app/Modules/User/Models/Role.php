<?php

namespace App\Modules\User\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /*
    public function user()
    {
        return $this->belongsToMany('App\Modules\User\Models\User');
    }
    public function permission()
    {
        return $this->belongsToMany('App\Modules\User\Models\Permission');
    }
    */
}