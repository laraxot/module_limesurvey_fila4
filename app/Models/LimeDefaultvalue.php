<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeDefaultvalue
 *
 * @property int $dvid
 * @property int $qid
 * @property int $scale_id
 * @property int $sqid
 * @property string $specialtype
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeDefaultvalue extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_defaultvalues';

    /** @var string */
    protected $primaryKey = 'qid';

    /** @var list<string> */
    protected $fillable = [
        'scale_id', 'sqid', 'language', 'specialtype', 'defaultvalue',
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
        'qid' => 'int', 'scale_id' => 'int', 'sqid' => 'int', 'language' => 'string', 'specialtype' => 'string', 'defaultvalue' => 'string',
    ];
    }

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
