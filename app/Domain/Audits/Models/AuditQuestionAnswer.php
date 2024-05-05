<?php

namespace App\Domain\Audits\Models;

use App\Domain\AuditBlocks\Models\AuditBlockQuestion;
use App\Domain\AuditBlocks\Models\AuditBlockQuestionAnswer;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Domain\Audits\Models\AuditQuestionAnswer
 *
 * @property-read AuditBlockQuestionAnswer|null $answer
 * @property-read AuditBlockQuestion|null $question
 * @method static Builder|AuditQuestionAnswer newModelQuery()
 * @method static Builder|AuditQuestionAnswer newQuery()
 * @method static Builder|AuditQuestionAnswer query()
 * @property int $id
 * @property int $audit_id
 * @property int $question_id
 * @property int $answer_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AuditQuestionAnswer whereAnswerId($value)
 * @method static Builder|AuditQuestionAnswer whereAuditId($value)
 * @method static Builder|AuditQuestionAnswer whereCreatedAt($value)
 * @method static Builder|AuditQuestionAnswer whereId($value)
 * @method static Builder|AuditQuestionAnswer whereQuestionId($value)
 * @method static Builder|AuditQuestionAnswer whereUpdatedAt($value)
 * @mixin Eloquent
 */
class AuditQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable =   [
        'audit_id',
        'question_id',
        'answer_id',
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(AuditBlockQuestion::class);
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(AuditBlockQuestionAnswer::class);
    }
}
