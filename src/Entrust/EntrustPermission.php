<?php

namespace Ucer\Entrust;

use Illuminate\Database\Eloquent\Model;
use Ucer\Entrust\Contracts\EntrustPermissionInterface;
use Illuminate\Support\Facades\Config;
use Ucer\Entrust\Traits\EntrustPermissionTrait;

class EntrustPermission extends Model implements EntrustPermissionInterface
{
    use EntrustPermissionTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('entrust.permissions_table');
    }
}