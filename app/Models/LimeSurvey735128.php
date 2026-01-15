<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey735128
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
class LimeSurvey735128 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_735128';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', 'startdate', 'datestamp', 'ipaddr', '735128X931X31971', '735128X931X31823', '735128X931X31824', '735128X931X31824other', '735128X931X31825', '735128X932X31826004_01', '735128X932X31826004_02', '735128X932X31826005_01', '735128X932X31826005_02', '735128X932X31826006_01', '735128X932X31826006_02', '735128X932X31826007_01', '735128X932X31826007_02', '735128X932X31826008_01', '735128X932X31826008_02', '735128X932X31826009_01', '735128X932X31826009_02', '735128X932X31826010_01', '735128X932X31826010_02', '735128X932X31826011_01', '735128X932X31826011_02', '735128X932X31826012_01', '735128X932X31826012_02', '735128X932X31826013_01', '735128X932X31826013_02', '735128X932X31826014_01', '735128X932X31826014_02', '735128X932X31826015_01', '735128X932X31826015_02', '735128X932X31826016_01', '735128X932X31826016_02', '735128X932X31826017_01', '735128X932X31826017_02', '735128X932X31826018_01', '735128X932X31826018_02', '735128X932X31826019_01', '735128X932X31826019_02', '735128X932X31826020_01', '735128X932X31826020_02', '735128X932X31887', '735128X932X31888', '735128X932X31889023_001', '735128X932X31889023_002', '735128X932X31947', '735128X932X31948025_001', '735128X932X31948025_002', '735128X933X31827', '735128X933X31952', '735128X933X31953', '735128X933X319541', '735128X933X319542', '735128X933X319543', '735128X933X319544', '735128X933X319545', '735128X933X319546', '735128X933X319547', '735128X933X319548', '735128X933X319549', '735128X934X31829', '735128X934X31830', '735128X934X31831', '735128X934X31831other', '735128X934X31832', '735128X934X31967', '735128X934X31965', '735128X935X31966', '735128X935X31968', '735128X935X31969', '735128X935X31970', '735128X935X31972', '735128X935X32032', '735128X935X32032other',
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
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', 'startdate' => 'datetime', 'datestamp' => 'datetime', 'ipaddr' => 'string', '735128X931X31971' => 'string', '735128X931X31823' => 'string', '735128X931X31824' => 'string', '735128X931X31824other' => 'string', '735128X931X31825' => 'string', '735128X932X31826004_01' => 'string', '735128X932X31826004_02' => 'string', '735128X932X31826005_01' => 'string', '735128X932X31826005_02' => 'string', '735128X932X31826006_01' => 'string', '735128X932X31826006_02' => 'string', '735128X932X31826007_01' => 'string', '735128X932X31826007_02' => 'string', '735128X932X31826008_01' => 'string', '735128X932X31826008_02' => 'string', '735128X932X31826009_01' => 'string', '735128X932X31826009_02' => 'string', '735128X932X31826010_01' => 'string', '735128X932X31826010_02' => 'string', '735128X932X31826011_01' => 'string', '735128X932X31826011_02' => 'string', '735128X932X31826012_01' => 'string', '735128X932X31826012_02' => 'string', '735128X932X31826013_01' => 'string', '735128X932X31826013_02' => 'string', '735128X932X31826014_01' => 'string', '735128X932X31826014_02' => 'string', '735128X932X31826015_01' => 'string', '735128X932X31826015_02' => 'string', '735128X932X31826016_01' => 'string', '735128X932X31826016_02' => 'string', '735128X932X31826017_01' => 'string', '735128X932X31826017_02' => 'string', '735128X932X31826018_01' => 'string', '735128X932X31826018_02' => 'string', '735128X932X31826019_01' => 'string', '735128X932X31826019_02' => 'string', '735128X932X31826020_01' => 'string', '735128X932X31826020_02' => 'string', '735128X932X31887' => 'string', '735128X932X31888' => 'string', '735128X932X31889023_001' => 'string', '735128X932X31889023_002' => 'string', '735128X932X31947' => 'string', '735128X932X31948025_001' => 'string', '735128X932X31948025_002' => 'string', '735128X933X31827' => 'string', '735128X933X31952' => 'string', '735128X933X31953' => 'string', '735128X933X319541' => 'string', '735128X933X319542' => 'string', '735128X933X319543' => 'string', '735128X933X319544' => 'string', '735128X933X319545' => 'string', '735128X933X319546' => 'string', '735128X933X319547' => 'string', '735128X933X319548' => 'string', '735128X933X319549' => 'string', '735128X934X31829' => 'string', '735128X934X31830' => 'string', '735128X934X31831' => 'string', '735128X934X31831other' => 'string', '735128X934X31832' => 'string', '735128X934X31967' => 'string', '735128X934X31965' => 'string', '735128X935X31966' => 'string', '735128X935X31968' => 'string', '735128X935X31969' => 'datetime', '735128X935X31970' => 'datetime', '735128X935X31972' => 'string', '735128X935X32032' => 'string', '735128X935X32032other' => 'string',
    ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
