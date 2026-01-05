<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeAnswerL10n
 *
 * @property int $id
 * @property int $aid
 * @property string $answer
 * @property string $language
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder|LimeAnswerL10n all($columns = [])
 * @method static CachedBuilder|LimeAnswerL10n avg($column)
 * @method static CachedBuilder|LimeAnswerL10n cache(array $tags = [])
 * @method static CachedBuilder|LimeAnswerL10n cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|LimeAnswerL10n count($columns = '*')
 * @method static CachedBuilder|LimeAnswerL10n disableCache()
 * @method static CachedBuilder|LimeAnswerL10n disableModelCaching()
 * @method static CachedBuilder|LimeAnswerL10n exists()
 * @method static CachedBuilder|LimeAnswerL10n flushCache(array $tags = [])
 * @method static CachedBuilder|LimeAnswerL10n getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|LimeAnswerL10n inRandomOrder($seed = '')
 * @method static CachedBuilder|LimeAnswerL10n insert(array $values)
 * @method static CachedBuilder|LimeAnswerL10n isCachable()
 * @method static CachedBuilder|LimeAnswerL10n max($column)
 * @method static CachedBuilder|LimeAnswerL10n min($column)
 * @method static CachedBuilder|LimeAnswerL10n newModelQuery()
 * @method static CachedBuilder|LimeAnswerL10n newQuery()
 * @method static CachedBuilder|LimeAnswerL10n ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|LimeAnswerL10n query()
 * @method static CachedBuilder|LimeAnswerL10n sum($column)
 * @method static CachedBuilder|LimeAnswerL10n truncate()
 * @method static CachedBuilder|LimeAnswerL10n whereAid($value)
 * @method static CachedBuilder|LimeAnswerL10n whereAnswer($value)
 * @method static CachedBuilder|LimeAnswerL10n whereId($value)
 * @method static CachedBuilder|LimeAnswerL10n whereLanguage($value)
 * @method static CachedBuilder|LimeAnswerL10n withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeAnswerL10n extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_answer_l10ns';

    protected $casts = [
        'aid' => 'int',
    ];

    protected $fillable = [
        'aid',
        'answer',
        'language',
    ];
}
