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
 * @method static CachedBuilder|TokensResponse all($columns = [])
 * @method static CachedBuilder|TokensResponse avg($column)
 * @method static CachedBuilder|TokensResponse cache(array $tags = [])
 * @method static CachedBuilder|TokensResponse cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|TokensResponse count($columns = '*')
 * @method static CachedBuilder|TokensResponse disableCache()
 * @method static CachedBuilder|TokensResponse disableModelCaching()
 * @method static CachedBuilder|TokensResponse exists()
 * @method static CachedBuilder|TokensResponse flushCache(array $tags = [])
 * @method static CachedBuilder|TokensResponse getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|TokensResponse inRandomOrder($seed = '')
 * @method static CachedBuilder|TokensResponse insert(array $values)
 * @method static CachedBuilder|TokensResponse isCachable()
 * @method static CachedBuilder|TokensResponse max($column)
 * @method static CachedBuilder|TokensResponse min($column)
 * @method static CachedBuilder|TokensResponse newModelQuery()
 * @method static CachedBuilder|TokensResponse newQuery()
 * @method static CachedBuilder|TokensResponse ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder|TokensResponse query()
 * @method static CachedBuilder|TokensResponse sum($column)
 * @method static CachedBuilder|TokensResponse truncate()
 * @method static CachedBuilder|TokensResponse withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class TokensResponse extends BaseModel
{
    /** @var string */
    protected $primaryKey = 'tid';

    // Il nome della tabella viene impostato dinamicamente
    public function setTableForSurvey($surveyId): void
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
