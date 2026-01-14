<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Limesurvey\Database\Factories\LimeUserGroupFactory;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeUserGroup
 *
 * @method static LimeUserGroupFactory factory($count = null, $state = [])
 *
 * @property int $ugid
 * @property string $name
 * @property string $description
 * @property int $owner_id
 *
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeUserGroup extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_user_groups';

    /** @var string */
    protected $primaryKey = 'ugid';

    /** @var list<string> */
    protected $fillable = [
        'name', 'description', 'owner_id',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'ugid' => 'int', 'name' => 'string', 'description' => 'string', 'owner_id' => 'int',
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
