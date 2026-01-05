<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeQuestionAttribute
 *
 * @property int $qaid
 * @property int $qid
 * @property string|null $attribute
 * @property string|null $value
 * @property string|null $language
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeQuestionAttribute all($columns = [])
 * @method static CachedBuilder|LimeQuestionAttribute avg($column)
 * @method static CachedBuilder|LimeQuestionAttribute cache(array $tags = [])
 * @method static CachedBuilder|LimeQuestionAttribute cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeQuestionAttribute count($columns = '*')
 * @method static CachedBuilder|LimeQuestionAttribute disableCache()
 * @method static CachedBuilder|LimeQuestionAttribute disableModelCaching()
 * @method static CachedBuilder|LimeQuestionAttribute exists()
 * @method static CachedBuilder|LimeQuestionAttribute flushCache(array $tags = [])
 * @method static CachedBuilder|LimeQuestionAttribute getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeQuestionAttribute inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeQuestionAttribute insert(array $values)
 * @method static CachedBuilder|LimeQuestionAttribute isCachable()
 * @method static CachedBuilder|LimeQuestionAttribute max($column)
 * @method static CachedBuilder|LimeQuestionAttribute min($column)
 * @method static CachedBuilder|LimeQuestionAttribute newModelQuery()
 * @method static CachedBuilder|LimeQuestionAttribute newQuery()
 * @method static CachedBuilder|LimeQuestionAttribute ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeQuestionAttribute query()
 * @method static CachedBuilder|LimeQuestionAttribute sum($column)
 * @method static CachedBuilder|LimeQuestionAttribute truncate()
 * @method static CachedBuilder|LimeQuestionAttribute whereAttribute($value)
 * @method static CachedBuilder|LimeQuestionAttribute whereLanguage($value)
 * @method static CachedBuilder|LimeQuestionAttribute whereQaid($value)
 * @method static CachedBuilder|LimeQuestionAttribute whereQid($value)
 * @method static CachedBuilder|LimeQuestionAttribute whereValue($value)
 * @method static CachedBuilder|LimeQuestionAttribute withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeQuestionAttribute extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_question_attributes';

    /** @var string */
    protected $primaryKey = 'qaid';

    /** @var list<string> */
    protected $fillable = [
        'qid', 'attribute', 'value', 'language',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'qaid' => 'int', 'qid' => 'int', 'attribute' => 'string', 'value' => 'string', 'language' => 'string',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
