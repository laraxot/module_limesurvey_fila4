<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeGroup
 *
 * @property int $gid
 * @property int $sid
 * @property int $group_order
 * @property string $randomization_group
 * @property string|null $grelevance
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read string $group_name
 * @property-read LimeGroupL10n|null $labels
 * @property-read Profile|null $updater
 *
 *
 * @mixin \Eloquent
 */
class LimeGroup extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_groups';

    /** @var string */
    protected $primaryKey = 'gid';

    /** @var list<string> */
    protected $fillable = [
        'language', 'sid', 'group_name', 'group_order', 'description', 'randomization_group', 'grelevance',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'gid' => 'int', 'language' => 'string', 'sid' => 'int', 'group_name' => 'string', 'group_order' => 'int', 'description' => 'string', 'randomization_group' => 'string', 'grelevance' => 'string',
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
    public function labels(): HasOne
    {
        return $this->hasOne(LimeGroupL10n::class, 'gid', 'gid')
            ->where('language', app()->getLocale());
    }

    // Mutators

    public function getGroupNameAttribute(): string
    {
        return $this->labels->group_name ?? '';
    }
}
