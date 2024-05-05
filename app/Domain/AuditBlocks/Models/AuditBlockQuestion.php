<?php

namespace App\Domain\AuditBlocks\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Domain\AuditBlocks\Models\AuditBlockQuestion
 *
 * @property-read AuditBlock|null $auditBlock
 * @property-read Collection<int, AuditBlockQuestionAnswer> $auditBlockQuestionAnswers
 * @property-read int|null $audit_block_question_answers_count
 * @method static Builder|AuditBlockQuestion newModelQuery()
 * @method static Builder|AuditBlockQuestion newQuery()
 * @method static Builder|AuditBlockQuestion query()
 * @property int $id
 * @property string $name
 * @property int $audit_block_id
 * @property bool $is_answer_required
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AuditBlockQuestion whereAuditBlockId($value)
 * @method static Builder|AuditBlockQuestion whereCreatedAt($value)
 * @method static Builder|AuditBlockQuestion whereId($value)
 * @method static Builder|AuditBlockQuestion whereIsAnswerRequired($value)
 * @method static Builder|AuditBlockQuestion whereName($value)
 * @method static Builder|AuditBlockQuestion whereUpdatedAt($value)
 * @property bool $is_hidden
 * @method static Builder|AuditBlockQuestion whereIsHidden($value)
 * @mixin Eloquent
 */
class AuditBlockQuestion extends Model
{
    use HasFactory;

    protected $fillable =   [
        'name',
        'audit_block_id'
    ];

    protected $table = 'audit_block_questions';

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    public function auditBlock(): BelongsTo
    {
        return $this->belongsTo(AuditBlock::class);
    }

    public function auditBlockQuestionAnswers(): HasMany
    {
        return $this->hasMany(AuditBlockQuestionAnswer::class);
    }
}
