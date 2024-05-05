<?php

namespace App\Domain\Users\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Domain\Users\Models\RoleUser
 *
 * @method static Builder|RoleUser newModelQuery()
 * @method static Builder|RoleUser newQuery()
 * @method static Builder|RoleUser query()
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|RoleUser whereCreatedAt($value)
 * @method static Builder|RoleUser whereId($value)
 * @method static Builder|RoleUser whereRoleId($value)
 * @method static Builder|RoleUser whereUpdatedAt($value)
 * @method static Builder|RoleUser whereUserId($value)
 * @mixin Eloquent
 */
class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'role_user';

    protected $fillable =   [
        'user_id',
        'role_id',
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];
}
