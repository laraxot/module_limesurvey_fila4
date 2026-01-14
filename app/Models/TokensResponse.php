<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder all($columns = [])
 * @method static CachedBuilder avg($column)
 * @method static CachedBuilder cache(array $tags = [])
 * @method static CachedBuilder cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder count($columns = '*')
 * @method static CachedBuilder disableCache()
 * @method static CachedBuilder disableModelCaching()
 * @method static CachedBuilder exists()
 * @method static CachedBuilder flushCache(array $tags = [])
 * @method static CachedBuilder getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder inRandomOrder($seed = '')
 * @method static CachedBuilder insert(array $values)
 * @method static CachedBuilder isCachable()
 * @method static CachedBuilder max($column)
 * @method static CachedBuilder min($column)
 * @method static CachedBuilder newModelQuery()
 * @method static CachedBuilder newQuery()
 * @method static CachedBuilder ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder query()
 * @method static CachedBuilder sum($column)
 * @method static CachedBuilder truncate()
 * @method static CachedBuilder withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class TokensResponse extends BaseModel
{
    /** @var string */
    protected $primaryKey = 'tid';

    /**
     * Il nome della tabella viene impostato dinamicamente
     */
    public function setTableForSurvey(string $surveyId): void
    {
        $this->setTable('lime_tokens_'.$surveyId);
    }

    /**
     * @return Builder<self>
     */
    public static function getResponsesForSurvey(string $surveyId): Builder
    {
        $instance = new static();
        $instance->setTableForSurvey($surveyId);

        return $instance->newQuery();
    }
}
