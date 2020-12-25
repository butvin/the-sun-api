<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use App\Http\Resources\UsersCollection;
use App\Models\Role;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use SoftDeletes,
        Authenticatable,
        Authorizable,
        HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * @return array
     */
    public function isActiveStatus(): array
    {
        return $this->status;
    }

    /**
     * Get the role that owns the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role(): HasOne
    {
        return $this
            ->hasOne(\App\Models\Role::class, 'id', 'role_id')
            ->where('status', '=', 1);
    }

    /**
     * @param  string[]  $columns
     *
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function allUsersActiveStatus($columns = ['*'])
    {
        return parent::all($columns)
            ->where('status', '=', 1);
    }

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'email', 'status', 'phone',
        'fb_token', 'gl_token', 'api_token', 'password',
        'created_at', 'updated_at', 'verified_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'deleted_at', 'role_id',
        'gl_token', 'fb_token', //'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'verified_at' => 'datetime:d/m/Y H:i:s',
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s',
        'deleted_at' => 'datetime:d/m/Y H:i:s',
    ];

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new UsersCollection($models);
    }
}
