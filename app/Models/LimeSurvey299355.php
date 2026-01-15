<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey299355
 *
 * @property int $id
 * @property string|null $token
 * @property Carbon|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 * @property Carbon $startdate
 * @property Carbon $datestamp
 * @property string|null $ipaddr
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey299355 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_299355';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '299355X1029X33153', '299355X1029X33154', '299355X1029X33154other', '299355X1029X33155', '299355X1030X331564#0', '299355X1030X331564#1', '299355X1030X331565#0', '299355X1030X331565#1', '299355X1030X331566#0', '299355X1030X331566#1', '299355X1030X331567#0', '299355X1030X331567#1', '299355X1030X331568#0', '299355X1030X331568#1', '299355X1030X331569#0', '299355X1030X331569#1', '299355X1030X3315610#0', '299355X1030X3315610#1', '299355X1030X3315611#0', '299355X1030X3315611#1', '299355X1030X3315612#0', '299355X1030X3315612#1', '299355X1030X3315613#0', '299355X1030X3315613#1', '299355X1030X3315614#0', '299355X1030X3315614#1', '299355X1030X3315615#0', '299355X1030X3315615#1', '299355X1030X3315616#0', '299355X1030X3315616#1', '299355X1030X3315617#0', '299355X1030X3315617#1', '299355X1030X3315618#0', '299355X1030X3315618#1', '299355X1030X3315619#0', '299355X1030X3315619#1', '299355X1031X33157', '299355X1031X33158', '299355X1032X33159', '299355X1032X33160', '299355X1032X33161', '299355X1032X33161other', '299355X1032X33162', '299355X1032X33163', '299355X1032X33164',
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
            'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '299355X1029X33153' => 'string', '299355X1029X33154' => 'string', '299355X1029X33154other' => 'string', '299355X1029X33155' => 'string', '299355X1030X331564#0' => 'string', '299355X1030X331564#1' => 'string', '299355X1030X331565#0' => 'string', '299355X1030X331565#1' => 'string', '299355X1030X331566#0' => 'string', '299355X1030X331566#1' => 'string', '299355X1030X331567#0' => 'string', '299355X1030X331567#1' => 'string', '299355X1030X331568#0' => 'string', '299355X1030X331568#1' => 'string', '299355X1030X331569#0' => 'string', '299355X1030X331569#1' => 'string', '299355X1030X3315610#0' => 'string', '299355X1030X3315610#1' => 'string', '299355X1030X3315611#0' => 'string', '299355X1030X3315611#1' => 'string', '299355X1030X3315612#0' => 'string', '299355X1030X3315612#1' => 'string', '299355X1030X3315613#0' => 'string', '299355X1030X3315613#1' => 'string', '299355X1030X3315614#0' => 'string', '299355X1030X3315614#1' => 'string', '299355X1030X3315615#0' => 'string', '299355X1030X3315615#1' => 'string', '299355X1030X3315616#0' => 'string', '299355X1030X3315616#1' => 'string', '299355X1030X3315617#0' => 'string', '299355X1030X3315617#1' => 'string', '299355X1030X3315618#0' => 'string', '299355X1030X3315618#1' => 'string', '299355X1030X3315619#0' => 'string', '299355X1030X3315619#1' => 'string', '299355X1031X33157' => 'string', '299355X1031X33158' => 'string', '299355X1032X33159' => 'string', '299355X1032X33160' => 'string', '299355X1032X33161' => 'string', '299355X1032X33161other' => 'string', '299355X1032X33162' => 'string', '299355X1032X33163' => 'string', '299355X1032X33164' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
