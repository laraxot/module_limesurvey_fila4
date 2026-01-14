<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Database\Factories\LimeSurveymenuEntryFactory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurveymenuEntry
 *
 * @method static LimeSurveymenuEntryFactory factory($count = null, $state = [])
 *
 * @property int $id
 * @property int|null $menu_id
 * @property int|null $user_id
 * @property int|null $ordering
 * @property string|null $name
 * @property string $title
 * @property string $menu_title
 * @property string|null $menu_description
 * @property string $menu_icon
 * @property string $menu_icon_type
 * @property string $menu_class
 * @property string $menu_link
 * @property string $action
 * @property string $template
 * @property string $partial
 * @property string $classes
 * @property string $permission
 * @property string|null $permission_grade
 * @property string|null $data
 * @property string $getdatamethod
 * @property string $language
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
class LimeSurveymenuEntry extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_surveymenu_entries';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'menu_id', 'user_id', 'ordering', 'name', 'title', 'menu_title', 'menu_description', 'menu_icon', 'menu_icon_type', 'menu_class', 'menu_link', 'action', 'template', 'partial', 'classes', 'permission', 'permission_grade', 'data', 'getdatamethod', 'language', 'showincollapse', 'active', 'changed_at', 'changed_by', 'created_at', 'created_by',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'menu_id' => 'int', 'user_id' => 'int', 'ordering' => 'int', 'name' => 'string', 'title' => 'string', 'menu_title' => 'string', 'menu_description' => 'string', 'menu_icon' => 'string', 'menu_icon_type' => 'string', 'menu_class' => 'string', 'menu_link' => 'string', 'action' => 'string', 'template' => 'string', 'partial' => 'string', 'classes' => 'string', 'permission' => 'string', 'permission_grade' => 'string', 'data' => 'string', 'getdatamethod' => 'string', 'language' => 'string', 'showincollapse' => 'int', 'active' => 'int', 'changed_at' => 'datetime', 'changed_by' => 'int', 'created_at' => 'datetime', 'created_by' => 'int',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
