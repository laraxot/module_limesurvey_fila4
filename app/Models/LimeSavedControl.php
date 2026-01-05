<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Support\Carbon;

/**
 * Modules\Limesurvey\Models\LimeSavedControl
 *
 * @property int $scid
 * @property int $sid
 * @property int $srid
 * @property string $identifier
 * @property string $access_code
 * @property string|null $email
 * @property string $ip
 * @property string $saved_thisstep
 * @property string $status
 * @property Carbon $saved_date
 * @property string|null $refurl
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeSavedControl all($columns = [])
 * @method static CachedBuilder<static>|LimeSavedControl avg($column)
 * @method static CachedBuilder<static>|LimeSavedControl cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSavedControl cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeSavedControl count($columns = '*')
 * @method static CachedBuilder<static>|LimeSavedControl disableCache()
 * @method static CachedBuilder<static>|LimeSavedControl disableModelCaching()
 * @method static CachedBuilder<static>|LimeSavedControl exists()
 * @method static CachedBuilder<static>|LimeSavedControl flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSavedControl getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder<static>|LimeSavedControl inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeSavedControl insert(array $values)
 * @method static CachedBuilder<static>|LimeSavedControl isCachable()
 * @method static CachedBuilder<static>|LimeSavedControl max($column)
 * @method static CachedBuilder<static>|LimeSavedControl min($column)
 * @method static CachedBuilder<static>|LimeSavedControl newModelQuery()
 * @method static CachedBuilder<static>|LimeSavedControl newQuery()
 * @method static CachedBuilder<static>|LimeSavedControl ofFilterData(AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeSavedControl query()
 * @method static CachedBuilder<static>|LimeSavedControl sum($column)
 * @method static CachedBuilder<static>|LimeSavedControl truncate()
 * @method static CachedBuilder<static>|LimeSavedControl whereAccessCode($value)
 * @method static CachedBuilder<static>|LimeSavedControl whereEmail($value)
 * @method static CachedBuilder<static>|LimeSavedControl whereIdentifier($value)
 * @method static CachedBuilder<static>|LimeSavedControl whereIp($value)
 * @method static CachedBuilder<static>|LimeSavedControl whereRefurl($value)
 * @method static CachedBuilder<static>|LimeSavedControl whereSavedDate($value)
 * @method static CachedBuilder<static>|LimeSavedControl whereSavedThisstep($value)
 * @method static CachedBuilder<static>|LimeSavedControl whereScid($value)
 * @method static CachedBuilder<static>|LimeSavedControl whereSid($value)
 * @method static CachedBuilder<static>|LimeSavedControl whereSrid($value)
 * @method static CachedBuilder<static>|LimeSavedControl whereStatus($value)
 * @method static CachedBuilder<static>|LimeSavedControl withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeSavedControl extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_saved_control';

    /** @var string */
    protected $primaryKey = 'scid';

    /** @var array<int, string> */
    protected $fillable = [
        'sid', 'srid', 'identifier', 'access_code', 'email', 'ip', 'saved_thisstep', 'status', 'saved_date', 'refurl',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'scid' => 'int', 'sid' => 'int', 'srid' => 'int', 'identifier' => 'string', 'access_code' => 'string', 'email' => 'string', 'ip' => 'string', 'saved_thisstep' => 'string', 'status' => 'string', 'saved_date' => 'datetime', 'refurl' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
