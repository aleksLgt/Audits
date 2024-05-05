<?php

namespace App\Domain\AuditBlocks\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Domain\AuditBlocks\Models\AuditBlockQuestionAnswer
 *
 * @property-read AuditBlockQuestion|null $auditBlockQuestion
 * @method static Builder|AuditBlockQuestionAnswer newModelQuery()
 * @method static Builder|AuditBlockQuestionAnswer newQuery()
 * @method static Builder|AuditBlockQuestionAnswer query()
 * @property int $id
 * @property string $name
 * @property int $audit_block_question_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AuditBlockQuestionAnswer whereAuditBlockQuestionId($value)
 * @method static Builder|AuditBlockQuestionAnswer whereCreatedAt($value)
 * @method static Builder|AuditBlockQuestionAnswer whereId($value)
 * @method static Builder|AuditBlockQuestionAnswer whereName($value)
 * @method static Builder|AuditBlockQuestionAnswer whereUpdatedAt($value)
 * @mixin Eloquent
 */
class AuditBlockQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable =   [
        'name',
        'audit_block_question_id',
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    public function auditBlockQuestion(): BelongsTo
    {
        return $this->belongsTo(AuditBlockQuestion::class);
    }
}
