<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeQuotum
 *
 * @property int $id
 * @property int|null $sid
 * @property string|null $name
 * @property int|null $qlimit
 * @property int|null $action
 * @property int $active
 * @property int $autoload_url
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeQuotum extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_quota';

    protected $casts = [
        'sid' => 'int',
        'qlimit' => 'int',
        'action' => 'int',
        'active' => 'int',
        'autoload_url' => 'int',
    ];

    protected $fillable = [
        'sid',
        'name',
        'qlimit',
        'action',
        'active',
        'autoload_url',
    ];
}
