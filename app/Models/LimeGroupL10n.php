<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeGroupL10n
 *
 * @property int $id
 * @property int $gid
 * @property string $group_name
 * @property string|null $description
 * @property string $language
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeGroupL10n extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_group_l10ns';

    protected $casts = [
        'gid' => 'int',
    ];

    protected $fillable = [
        'gid',
        'group_name',
        'description',
        'language',
    ];
}
