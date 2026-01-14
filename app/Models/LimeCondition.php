<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
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

    /** @return array<string, string>     */
    protected $casts = [
        'cid' => 'int', 'qid' => 'int', 'cqid' => 'int', 'cfieldname' => 'string', 'method' => 'string', 'value' => 'string', 'scenario' => 'int',
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
