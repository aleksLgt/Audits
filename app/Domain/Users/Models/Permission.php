<?php

namespace App\Domain\Users\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Domain\Users\Models\Permission
 *
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission query()
 * @property int $id
 * @property string $name
 * @property string $uri
 * @property string $method
 * @property string $group
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Permission whereCreatedAt($value)
 * @method static Builder|Permission whereGroup($value)
 * @method static Builder|Permission whereId($value)
 * @method static Builder|Permission whereMethod($value)
 * @method static Builder|Permission whereName($value)
 * @method static Builder|Permission whereUpdatedAt($value)
 * @method static Builder|Permission whereUri($value)
 * @mixin Eloquent
 */
class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable =   [
        'name',
        'uri',
        'method',
        'group'
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];
}
