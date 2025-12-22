<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse all($columns = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse avg($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse cache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse cachedValue(array $arguments, string $cacheKey)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse disableModelCaching()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse exists()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse flushCache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse inRandomOrder($seed = '')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse insert(array $values)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse isCachable()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse max($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse min($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse query()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse sum($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse truncate()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|TokensResponse withCacheCooldownSeconds(?int $seconds = null)
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
