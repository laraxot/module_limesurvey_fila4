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
 * @method static CachedBuilder<static>|TokensResponse all($columns = [])
 * @method static CachedBuilder<static>|TokensResponse avg($column)
 * @method static CachedBuilder<static>|TokensResponse cache(array $tags = [])
 * @method static CachedBuilder<static>|TokensResponse cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|TokensResponse count($columns = '*')
 * @method static CachedBuilder<static>|TokensResponse disableCache()
 * @method static CachedBuilder<static>|TokensResponse disableModelCaching()
 * @method static CachedBuilder<static>|TokensResponse exists()
 * @method static CachedBuilder<static>|TokensResponse flushCache(array $tags = [])
 * @method static CachedBuilder<static>|TokensResponse getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|TokensResponse inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|TokensResponse insert(array $values)
 * @method static CachedBuilder<static>|TokensResponse isCachable()
 * @method static CachedBuilder<static>|TokensResponse max($column)
 * @method static CachedBuilder<static>|TokensResponse min($column)
 * @method static CachedBuilder<static>|TokensResponse newModelQuery()
 * @method static CachedBuilder<static>|TokensResponse newQuery()
 * @method static CachedBuilder<static>|TokensResponse ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|TokensResponse query()
 * @method static CachedBuilder<static>|TokensResponse sum($column)
 * @method static CachedBuilder<static>|TokensResponse truncate()
 * @method static CachedBuilder<static>|TokensResponse withCacheCooldownSeconds(?int $seconds = null)
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
