<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSession
 *
 * @property string $id
 * @property int|null $expire
 * @property string|null $data
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSession extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_sessions';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'expire', 'data',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'string', 'expire' => 'int',
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
