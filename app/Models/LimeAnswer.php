<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Limesurvey\Casts\LimeLangField;

/**
 * Modules\Limesurvey\Models\LimeAnswer
 *
 * @property int $aid
 * @property int $qid
 * @property string $code
 * @property int $sortorder
 * @property int $assessment_value
 * @property int $scale_id
 * @property int|string|array $answer
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read mixed $query
 * @property-read \Modules\Limesurvey\Models\LimeAnswerL10n|null $l10n
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeAnswer all($columns = [])
 * @method static CachedBuilder<static>|LimeAnswer avg($column)
 * @method static CachedBuilder<static>|LimeAnswer cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeAnswer cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeAnswer count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeAnswer disableCache()
 * @method static CachedBuilder<static>|LimeAnswer disableModelCaching()
 * @method static CachedBuilder<static>|LimeAnswer exists()
 * @method static CachedBuilder<static>|LimeAnswer flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeAnswer getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeAnswer inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeAnswer insert(array $values)
 * @method static CachedBuilder<static>|LimeAnswer isCachable()
 * @method static CachedBuilder<static>|LimeAnswer max($column)
 * @method static CachedBuilder<static>|LimeAnswer min($column)
 * @method static CachedBuilder<static>|LimeAnswer newModelQuery()
 * @method static CachedBuilder<static>|LimeAnswer newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeAnswer ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeAnswer query()
 * @method static CachedBuilder<static>|LimeAnswer sum($column)
 * @method static CachedBuilder<static>|LimeAnswer truncate()
 * @method static CachedBuilder<static>|LimeAnswer whereAid($value)
 * @method static CachedBuilder<static>|LimeAnswer whereAssessmentValue($value)
 * @method static CachedBuilder<static>|LimeAnswer whereCode($value)
 * @method static CachedBuilder<static>|LimeAnswer whereQid($value)
 * @method static CachedBuilder<static>|LimeAnswer whereScaleId($value)
 * @method static CachedBuilder<static>|LimeAnswer whereSortorder($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeAnswer withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeAnswer extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_answers';

    protected $primaryKey = 'aid';

    /**
     * Undocumented variable.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'qid' => 'int',
        'sortorder' => 'int',
        'assessment_value' => 'int',
        'scale_id' => 'int',
        'answer' => LimeLangField::class,
    ];

    /** @var list<string> */
    protected $fillable = [
        'qid',
        'code',
        'sortorder',
        'assessment_value',
        'scale_id',
    ];

    protected $appends = [
        'query',
    ];

    /**
     * Undocumented variable.
     *
     * @var array<string >
     */
    protected $with = [
        'l10n',
    ];

    /**
     * Undocumented function.
     */
    public function l10n(): HasOne
    {
        $lang = app()->getLocale();
        $class = static::class.'L10n';
        $pk = $this->primaryKey;

        return $this->hasOne($class, $pk, $pk)
            ->where('language', $lang);
    }

    public function getQueryAttribute() {}
}
