<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeCondition
 *
 * @property int $cid
 * @property int $qid
 * @property int $cqid
 * @property string $cfieldname
 * @property string $method
 * @property string $value
 * @property int $scenario
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeCondition extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_conditions';

    /** @var string */
    protected $primaryKey = 'cid';

    /** @var list<string> */
    protected $fillable = [
        'qid', 'cqid', 'cfieldname', 'method', 'value', 'scenario',
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
            'cid' => 'int', 'qid' => 'int', 'cqid' => 'int', 'cfieldname' => 'string', 'method' => 'string', 'value' => 'string', 'scenario' => 'int',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
