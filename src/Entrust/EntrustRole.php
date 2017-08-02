<?php
namespace Ucer\Entrust;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Ucer\Entrust\Traits\EntrustRoleTrait;
use Ucer\Entrust\Contracts\EntrustRoleInterface;

class EntrustRole extends Model implements EntrustRoleInterface
{
    use EntrustRoleTrait;

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
        $this->table = Config::get('entrust.roles_table');
    }
}
