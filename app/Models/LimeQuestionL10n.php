<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeQuestionL10n
 *
 * @property int $id
 * @property int $qid
 * @property string $question
 * @property string|null $help
 * @property string $language
 * @property string|null $script
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 * @method static CachedBuilder<static>|LimeQuestionL10n all($columns = [])
 * @method static CachedBuilder<static>|LimeQuestionL10n avg($column)
 * @method static CachedBuilder<static>|LimeQuestionL10n cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuestionL10n cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeQuestionL10n count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuestionL10n disableCache()
 * @method static CachedBuilder<static>|LimeQuestionL10n disableModelCaching()
 * @method static CachedBuilder<static>|LimeQuestionL10n exists()
 * @method static CachedBuilder<static>|LimeQuestionL10n flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeQuestionL10n getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeQuestionL10n inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeQuestionL10n insert(array $values)
 * @method static CachedBuilder<static>|LimeQuestionL10n isCachable()
 * @method static CachedBuilder<static>|LimeQuestionL10n max($column)
 * @method static CachedBuilder<static>|LimeQuestionL10n min($column)
 * @method static CachedBuilder<static>|LimeQuestionL10n newModelQuery()
 * @method static CachedBuilder<static>|LimeQuestionL10n newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuestionL10n ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeQuestionL10n query()
 * @method static CachedBuilder<static>|LimeQuestionL10n sum($column)
 * @method static CachedBuilder<static>|LimeQuestionL10n truncate()
 * @method static CachedBuilder<static>|LimeQuestionL10n whereHelp($value)
 * @method static CachedBuilder<static>|LimeQuestionL10n whereId($value)
 * @method static CachedBuilder<static>|LimeQuestionL10n whereLanguage($value)
 * @method static CachedBuilder<static>|LimeQuestionL10n whereQid($value)
 * @method static CachedBuilder<static>|LimeQuestionL10n whereQuestion($value)
 * @method static CachedBuilder<static>|LimeQuestionL10n whereScript($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeQuestionL10n withCacheCooldownSeconds(?int $seconds = null)
 * @mixin \Eloquent
 */
class LimeQuestionL10n extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_question_l10ns';

    protected $casts = [
        'qid' => 'int',
    ];

    protected $fillable = [
        'qid',
        'question',
        'help',
        'script',
        'language',
    ];
}
