<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use Modules\Limesurvey\Database\Factories\LimeTutorialEntryFactory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeTutorialEntry
 *
 * @method static LimeTutorialEntryFactory factory($count = null, $state = [])
 *
 * @property int $teid
 * @property int|null $ordering
 * @property string|null $title
 * @property string|null $content
 * @property string|null $settings
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeTutorialEntry extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_tutorial_entries';

    protected $primaryKey = 'teid';

    protected $casts = [
        'ordering' => 'int',
    ];

    protected $fillable = [
        'ordering',
        'title',
        'content',
        'settings',
    ];
}
