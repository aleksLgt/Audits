<?php

namespace App\Domain\Divisions\Models;

use App\Domain\Audits\Models\Audit;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Domain\Divisions\Models\Division
 *
 * @method static Builder|Division newModelQuery()
 * @method static Builder|Division newQuery()
 * @method static Builder|Division query()
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Division whereCreatedAt($value)
 * @method static Builder|Division whereId($value)
 * @method static Builder|Division whereName($value)
 * @method static Builder|Division whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions';

    protected $fillable =   [
        'name',
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    public function audits(): HasMany
    {
        return $this->hasMany(Audit::class);
    }
}
