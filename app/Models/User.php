<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use App\Http\Resources\UsersCollection;
use App\Models\Role;
use App\Models\UserAccessToken;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use SoftDeletes, Authenticatable, Authorizable, HasFactory;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userAccessToken(): HasOne
    {
        return $this
            ->hasOne(\App\Models\UserAccessToken::class, 'user_id', 'id')
            ->where('status', '=', 1);
    }

    /**
     * @param  string[]  $columns
     *
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function allUsersActiveStatus($columns = ['*'])
    {
        return parent::all($columns)->where('status', '=', 1);
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
        'verified_at',
//        'created_at', 'updated_at',
    ];
}
