<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use GeneaLabs\LaravelModelCaching\CachedBuilder;

/**
 * Modules\Limesurvey\Models\LimeFailedLoginAttempt
 *
 * @property int $id
 * @property string $ip
 * @property string $last_attempt
 * @property int $number_attempts
 * @property int $is_frontend
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt all($columns = [])
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt avg($column)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt count($columns = '*')
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt disableCache()
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt disableModelCaching()
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt exists()
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt insert(array $values)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt isCachable()
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt max($column)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt min($column)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt newModelQuery()
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt newQuery()
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt query()
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt sum($column)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt truncate()
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt whereId($value)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt whereIp($value)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt whereIsFrontend($value)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt whereLastAttempt($value)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt whereNumberAttempts($value)
 * @method static CachedBuilder<static>|LimeFailedLoginAttempt withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeFailedLoginAttempt extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_failed_login_attempts';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array<int, string> */
    protected $fillable = [
        'ip', 'last_attempt', 'number_attempts',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'ip' => 'string', 'last_attempt' => 'string', 'number_attempts' => 'int',
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
