<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Limesurvey\Casts\LimeLangField;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

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
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read mixed $query
 * @property-read LimeAnswerL10n|null $l10n
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeAnswer all($columns = [])
 * @method static CachedBuilder|LimeAnswer avg($column)
 * @method static CachedBuilder|LimeAnswer cache(array $tags = [])
 * @method static CachedBuilder|LimeAnswer cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeAnswer count($columns = '*')
 * @method static CachedBuilder|LimeAnswer disableCache()
 * @method static CachedBuilder|LimeAnswer disableModelCaching()
 * @method static CachedBuilder|LimeAnswer exists()
 * @method static CachedBuilder|LimeAnswer flushCache(array $tags = [])
 * @method static CachedBuilder|LimeAnswer getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeAnswer inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeAnswer insert(array $values)
 * @method static CachedBuilder|LimeAnswer isCachable()
 * @method static CachedBuilder|LimeAnswer max($column)
 * @method static CachedBuilder|LimeAnswer min($column)
 * @method static CachedBuilder|LimeAnswer newModelQuery()
 * @method static CachedBuilder|LimeAnswer newQuery()
 * @method static CachedBuilder|LimeAnswer ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeAnswer query()
 * @method static CachedBuilder|LimeAnswer sum($column)
 * @method static CachedBuilder|LimeAnswer truncate()
 * @method static CachedBuilder|LimeAnswer whereAid($value)
 * @method static CachedBuilder|LimeAnswer whereAssessmentValue($value)
 * @method static CachedBuilder|LimeAnswer whereCode($value)
 * @method static CachedBuilder|LimeAnswer whereQid($value)
 * @method static CachedBuilder|LimeAnswer whereScaleId($value)
 * @method static CachedBuilder|LimeAnswer whereSortorder($value)
 * @method static CachedBuilder|LimeAnswer withCacheCooldownSeconds(?int $seconds = null)
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

    public function getQueryAttribute(): void
    {
    }
}
