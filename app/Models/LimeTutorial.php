<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Limesurvey\Database\Factories\LimeTutorialFactory;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeTutorial
 *
 * @method static LimeTutorialFactory factory($count = null, $state = [])
 *
 * @property int $tid
 * @property string|null $name
 * @property string|null $title
 * @property string|null $icon
 * @property string|null $description
 * @property int|null $active
 * @property string|null $settings
 * @property string $permission
 * @property string $permission_grade
 *
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeTutorial extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_tutorials';

    /** @var string */
    protected $primaryKey = 'tid';

    /** @var list<string> */
    protected $fillable = [
        'name', 'title', 'icon', 'description', 'active', 'settings', 'permission', 'permission_grade',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'tid' => 'int', 'name' => 'string', 'title' => 'string', 'icon' => 'string', 'description' => 'string', 'active' => 'int', 'settings' => 'string', 'permission' => 'string', 'permission_grade' => 'string',
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
