<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Database\Factories\LimeSurveysGroupFactory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurveysGroup
 *
 * @method static LimeSurveysGroupFactory factory($count = null, $state = [])
 *
 * @property int $gsid
 * @property string $name
 * @property string|null $title
 * @property string|null $template
 * @property string|null $description
 * @property int $sortorder
 * @property int|null $owner_id
 * @property int|null $parent_id
 * @property Carbon|null $created
 * @property Carbon|null $modified
 * @property int $created_by
 * @property int|null $alwaysavailable
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurveysGroup extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_surveys_groups';

    /** @var string */
    protected $primaryKey = 'gsid';

    /** @var list<string> */
    protected $fillable = [
        'name', 'title', 'template', 'description', 'sortorder', 'owner_id', 'parent_id', 'created', 'modified', 'created_by',
    ];

    /** @var list<string> */
    protected $hidden = [
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
        'gsid' => 'int', 'name' => 'string', 'title' => 'string', 'template' => 'string', 'description' => 'string', 'sortorder' => 'int', 'owner_id' => 'int', 'parent_id' => 'int', 'created' => 'datetime', 'modified' => 'datetime', 'created_by' => 'int',
    ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
