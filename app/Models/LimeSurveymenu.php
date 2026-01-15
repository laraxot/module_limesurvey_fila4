<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Database\Factories\LimeSurveymenuFactory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurveymenu
 *
 * @method static LimeSurveymenuFactory factory($count = null, $state = [])
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $survey_id
 * @property int|null $user_id
 * @property string|null $name
 * @property int|null $ordering
 * @property int|null $level
 * @property string $title
 * @property string $position
 * @property string|null $description
 * @property int|null $showincollapse
 * @property int $active
 * @property Carbon|null $changed_at
 * @property int $changed_by
 * @property Carbon|null $created_at
 * @property int $created_by
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurveymenu extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_surveymenu';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'parent_id', 'survey_id', 'user_id', 'name', 'ordering', 'level', 'title', 'position', 'description', 'showincollapse', 'active', 'changed_at', 'changed_by', 'created_at', 'created_by',
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
            'id' => 'int', 'parent_id' => 'int', 'survey_id' => 'int', 'user_id' => 'int', 'name' => 'string', 'ordering' => 'int', 'level' => 'int', 'title' => 'string', 'position' => 'string', 'description' => 'string', 'showincollapse' => 'int', 'active' => 'int', 'changed_at' => 'datetime', 'changed_by' => 'int', 'created_at' => 'datetime', 'created_by' => 'int',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
