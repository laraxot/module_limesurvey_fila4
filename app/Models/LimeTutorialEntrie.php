<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Limesurvey\Database\Factories\LimeTutorialEntrieFactory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeTutorialEntrie
 *
 * @method static LimeTutorialEntrieFactory factory($count = null, $state = [])
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
class LimeTutorialEntrie extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_tutorial_entries';

    /** @var string */
    protected $primaryKey = 'teid';

    /** @var list<string> */
    protected $fillable = [
        'ordering', 'title', 'content', 'settings',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    /** @return array<string, string>     */
    /**
     * Get the casts for the model.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'teid' => 'int', 'ordering' => 'int', 'title' => 'string', 'content' => 'string', 'settings' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
