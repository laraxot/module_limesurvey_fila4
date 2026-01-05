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
 * @method static CachedBuilder<static>|LimeQuestionAttribute all($columns = [])
 * @method static CachedBuilder<static>|LimeQuestionAttribute avg($column)
 * @method static CachedBuilder<static>|LimeQuestionAttribute cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuestionAttribute cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeQuestionAttribute count($columns = '*')
 * @method static CachedBuilder<static>|LimeQuestionAttribute disableCache()
 * @method static CachedBuilder<static>|LimeQuestionAttribute disableModelCaching()
 * @method static CachedBuilder<static>|LimeQuestionAttribute exists()
 * @method static CachedBuilder<static>|LimeQuestionAttribute flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuestionAttribute getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeQuestionAttribute inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeQuestionAttribute insert(array $values)
 * @method static CachedBuilder<static>|LimeQuestionAttribute isCachable()
 * @method static CachedBuilder<static>|LimeQuestionAttribute max($column)
 * @method static CachedBuilder<static>|LimeQuestionAttribute min($column)
 * @method static CachedBuilder<static>|LimeQuestionAttribute newModelQuery()
 * @method static CachedBuilder<static>|LimeQuestionAttribute newQuery()
 * @method static CachedBuilder<static>|LimeQuestionAttribute ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeQuestionAttribute query()
 * @method static CachedBuilder<static>|LimeQuestionAttribute sum($column)
 * @method static CachedBuilder<static>|LimeQuestionAttribute truncate()
 * @method static CachedBuilder<static>|LimeQuestionAttribute whereAttribute($value)
 * @method static CachedBuilder<static>|LimeQuestionAttribute whereLanguage($value)
 * @method static CachedBuilder<static>|LimeQuestionAttribute whereQaid($value)
 * @method static CachedBuilder<static>|LimeQuestionAttribute whereQid($value)
 * @method static CachedBuilder<static>|LimeQuestionAttribute whereValue($value)
 * @method static CachedBuilder<static>|LimeQuestionAttribute withCacheCooldownSeconds(?int $seconds = null)
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

    /** @var array<int, string> */
    protected $fillable = [
        'qid', 'attribute', 'value', 'language',
    ];

    /** @var array<int, string> */
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
