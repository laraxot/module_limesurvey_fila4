<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeExpressionError
 *
 * @property int $id
 * @property string|null $errortime
 * @property int|null $sid
 * @property int|null $gid
 * @property int|null $qid
 * @property int|null $gseq
 * @property int|null $qseq
 * @property string|null $type
 * @property string|null $eqn
 * @property string|null $prettyprint
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 *
 * @mixin \Eloquent
 */
class LimeExpressionError extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_expression_errors';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'errortime', 'sid', 'gid', 'qid', 'gseq', 'qseq', 'type', 'eqn', 'prettyprint',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'errortime' => 'string', 'sid' => 'int', 'gid' => 'int', 'qid' => 'int', 'gseq' => 'int', 'qseq' => 'int', 'type' => 'string', 'eqn' => 'string', 'prettyprint' => 'string',
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
