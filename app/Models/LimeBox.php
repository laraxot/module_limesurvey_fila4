<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeBox
 *
 * @property int $id
 * @property int|null $position
 * @property string $url
 * @property string $title
 * @property string|null $ico
 * @property string $desc
 * @property string $page
 * @property int $usergroup
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeBox extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_boxes';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'position', 'url', 'title', 'ico', 'desc', 'page', 'usergroup',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'position' => 'int', 'url' => 'string', 'title' => 'string', 'ico' => 'string', 'desc' => 'string', 'page' => 'string', 'usergroup' => 'int',
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
