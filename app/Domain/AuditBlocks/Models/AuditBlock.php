<?php

namespace App\Domain\AuditBlocks\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Domain\AuditBlocks\Models\AuditBlock
 *
 * @property-read Collection<int, AuditBlockQuestion> $auditBlockQuestions
 * @property-read int|null $audit_block_questions_count
 * @method static Builder|AuditBlock newModelQuery()
 * @method static Builder|AuditBlock newQuery()
 * @method static Builder|AuditBlock query()
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AuditBlock whereCreatedAt($value)
 * @method static Builder|AuditBlock whereId($value)
 * @method static Builder|AuditBlock whereName($value)
 * @method static Builder|AuditBlock whereUpdatedAt($value)
 * @mixin Eloquent
 */
class AuditBlock extends Model
{
    use HasFactory;

    protected $fillable =   [
        'name',
    ];

    protected $table = 'audit_blocks';

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    public function auditBlockQuestions(): HasMany
    {
        return $this->hasMany(AuditBlockQuestion::class);
    }
}
