<?php

namespace Ucer\Entrust\Traits;

use Illuminate\Support\Facades\Config;

trait EntrustPermissionTrait
{
    /**
     * Many-to-Many relations with the role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('entrust.role'), Config::get('entrust.permission_role_table'));
    }
}