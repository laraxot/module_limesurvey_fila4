<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

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

    /** @var list<string> */
    protected $fillable = [
        'sid', 'srid', 'identifier', 'access_code', 'email', 'ip', 'saved_thisstep', 'status', 'saved_date', 'refurl',
    ];

    /** @var list<string> */
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
