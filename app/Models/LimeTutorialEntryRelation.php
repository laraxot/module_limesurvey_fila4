<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Limesurvey\Database\Factories\LimeTutorialEntryRelationFactory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeTutorialEntryRelation
 *
 * @method static LimeTutorialEntryRelationFactory factory($count = null, $state = [])
 *
 * @property int $teid
 * @property int $tid
 * @property int|null $uid
 * @property int|null $sid
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeTutorialEntryRelation extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_tutorial_entry_relation';

    /** @var string */
    protected $primaryKey = 'teid';

    /** @var list<string> */
    protected $fillable = [
        'tid', 'uid', 'sid',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'teid' => 'int', 'tid' => 'int', 'uid' => 'int', 'sid' => 'int',
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
