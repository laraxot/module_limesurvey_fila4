<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeQuotaLanguagesetting
 *
 * @property int $quotals_id
 * @property int $quotals_quota_id
 * @property string $quotals_language
 * @property string|null $quotals_name
 * @property string $quotals_message
 * @property string|null $quotals_url
 * @property string|null $quotals_urldescrip
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeQuotaLanguagesetting extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_quota_languagesettings';

    /** @var string */
    protected $primaryKey = 'quotals_id';

    /** @var list<string> */
    protected $fillable = [
        'quotals_quota_id', 'quotals_language', 'quotals_name', 'quotals_message', 'quotals_url', 'quotals_urldescrip',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'quotals_id' => 'int', 'quotals_quota_id' => 'int', 'quotals_language' => 'string', 'quotals_name' => 'string', 'quotals_message' => 'string', 'quotals_url' => 'string', 'quotals_urldescrip' => 'string',
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
