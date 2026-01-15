<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey726613
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
class LimeSurvey726613 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_726613';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '726613X995X33066', '726613X995X32856', '726613X995X32857', '726613X995X32858', '726613X995X32859', '726613X995X32860', '726613X995X32861', '726613X995X32862', '726613X995X328631', '726613X995X328632', '726613X995X328633', '726613X995X328634', '726613X995X328635', '726613X995X328711', '726613X995X328712', '726613X995X328713', '726613X995X32880', '726613X995X3288110', '726613X995X3288111', '726613X995X32890', '726613X995X32891', '726613X995X32892', '726613X995X32893', '726613X995X32894', '726613X995X3290512', '726613X995X3290513', '726613X995X3290514', '726613X995X3290515', '726613X995X3290516', '726613X995X3290517', '726613X995X3290518', '726613X995X3291519', '726613X995X3291520', '726613X995X3291521', '726613X995X3292722', '726613X995X32937', '726613X995X3293824', '726613X995X32940', '726613X995X32941', '726613X995X32942', '726613X995X32943', '726613X995X32944', '726613X995X32945', '726613X995X32833', '726613X995X32834', '726613X995X32834other',
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
            'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '726613X995X32856' => 'string', '726613X995X32857' => 'string', '726613X995X32858' => 'string', '726613X995X32859' => 'string', '726613X995X32860' => 'string', '726613X995X32861' => 'string', '726613X995X328631' => 'string', '726613X995X328632' => 'string', '726613X995X328633' => 'string', '726613X995X328634' => 'string', '726613X995X328635' => 'string', '726613X995X328711' => 'string', '726613X995X328712' => 'string', '726613X995X328713' => 'string', '726613X995X32880' => 'string', '726613X995X3288110' => 'string', '726613X995X3288111' => 'string', '726613X995X32890' => 'string', '726613X995X32891' => 'string', '726613X995X32892' => 'string', '726613X995X32893' => 'string', '726613X995X3290512' => 'string', '726613X995X3290513' => 'string', '726613X995X3290514' => 'string', '726613X995X3290515' => 'string', '726613X995X3290516' => 'string', '726613X995X3290517' => 'string', '726613X995X3290518' => 'string', '726613X995X3291519' => 'string', '726613X995X3291520' => 'string', '726613X995X3291521' => 'string', '726613X995X3292722' => 'string', '726613X995X32937' => 'string', '726613X995X3293824' => 'string', '726613X995X32940' => 'string', '726613X995X32941' => 'string', '726613X995X32942' => 'string', '726613X995X32943' => 'string', '726613X995X32944' => 'string', '726613X995X32945' => 'string', '726613X995X32833' => 'string', '726613X995X32834' => 'string', '726613X995X32834other' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
