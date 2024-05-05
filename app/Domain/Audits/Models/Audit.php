<?php

namespace App\Domain\Audits\Models;

use App\Domain\Divisions\Models\Division;
use App\Domain\Users\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Domain\Audits\Models\Audit
 *
 * @property-read Collection<int, AuditQuestionAnswer> $auditQuestionAnswers
 * @property-read int|null $audit_question_answers_count
 * @property-read Division|null $division
 * @property-read User|null $user
 * @method static Builder|Audit newModelQuery()
 * @method static Builder|Audit newQuery()
 * @method static Builder|Audit query()
 * @property int $id
 * @property string $name
 * @property int $division_id
 * @property int $user_id
 * @property string $planned_date_start
 * @property string $planned_date_end
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Audit whereCreatedAt($value)
 * @method static Builder|Audit whereDivisionId($value)
 * @method static Builder|Audit whereId($value)
 * @method static Builder|Audit whereName($value)
 * @method static Builder|Audit wherePlannedDateEnd($value)
 * @method static Builder|Audit wherePlannedDateStart($value)
 * @method static Builder|Audit whereUpdatedAt($value)
 * @method static Builder|Audit whereUserId($value)
 * @mixin Eloquent
 */
class Audit extends Model
{
    use HasFactory;

    protected $fillable =   [
        'name',
        'user_id',
        'planned_date_start',
        'planned_date_end',
        'division_id',
    ];

    protected $casts = [
//        'planned_date_start' => 'date: d-m-Y',
//        'planned_date_end'   => 'date: d-m-Y',
//        'created_at'        =>  'datetime: Y-m-d H:i:s',
//        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    protected $table = 'audits';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function auditQuestionAnswers(): HasMany
    {
        return $this->hasMany(AuditQuestionAnswer::class);
    }
}
