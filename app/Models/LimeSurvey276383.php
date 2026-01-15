<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey276383
 *
 * @property int $id
 * @property string|null $token
 * @property Carbon|null $submitdate
 * @property int|null $lastpage
 * @property string $startlanguage
 * @property string|null $seed
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurvey276383 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_276383';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', '276383X900X31445', '276383X900X31446', '276383X900X314481', '276383X900X314482', '276383X900X31447', '276383X900X31488', '276383X900X314491', '276383X900X314492', '276383X900X314493', '276383X900X314494', '276383X900X31450', '276383X900X31486', '276383X901X31451', '276383X901X314521', '276383X901X314522', '276383X901X314523', '276383X901X31453', '276383X901X314541', '276383X901X314542', '276383X901X314543', '276383X901X314544', '276383X901X31455', '276383X901X314561', '276383X901X314562', '276383X901X314563', '276383X901X31457', '276383X901X314581', '276383X901X314582', '276383X901X314583', '276383X902X31459', '276383X902X314601', '276383X902X314602', '276383X902X314603', '276383X902X314604', '276383X902X31461', '276383X902X31462', '276383X902X314631', '276383X902X314632', '276383X903X31464', '276383X903X314651', '276383X903X314652', '276383X903X31466', '276383X903X31489', '276383X903X31468', '276383X903X314691', '276383X903X314692', '276383X903X314693', '276383X903X31470', '276383X903X314711', '276383X903X314712', '276383X903X314713', '276383X903X31472', '276383X903X314731', '276383X903X314732', '276383X903X31474', '276383X903X314751', '276383X903X314752', '276383X903X31467', '276383X903X31476', '276383X903X314771', '276383X903X314772', '276383X904X31478', '276383X904X314791', '276383X904X314792', '276383X904X314793', '276383X904X31480', '276383X904X314811', '276383X904X314812', '276383X904X314813', '276383X904X314814', '276383X904X314815', '276383X904X31482', '276383X904X314831', '276383X904X314832', '276383X904X314833', '276383X904X314834', '276383X905X31484', '276383X905X314851', '276383X905X314852', '276383X905X31490', '276383X905X314911', '276383X905X314912', '276383X906X31487',
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
            'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', '276383X900X31445' => 'string', '276383X900X31446' => 'string', '276383X900X314481' => 'string', '276383X900X314482' => 'string', '276383X900X31447' => 'string', '276383X900X31488' => 'string', '276383X900X314491' => 'string', '276383X900X314492' => 'string', '276383X900X314493' => 'string', '276383X900X314494' => 'string', '276383X900X31450' => 'string', '276383X900X31486' => 'string', '276383X901X31451' => 'string', '276383X901X314521' => 'string', '276383X901X314522' => 'string', '276383X901X314523' => 'string', '276383X901X31453' => 'string', '276383X901X314541' => 'string', '276383X901X314542' => 'string', '276383X901X314543' => 'string', '276383X901X314544' => 'string', '276383X901X31455' => 'string', '276383X901X314561' => 'string', '276383X901X314562' => 'string', '276383X901X314563' => 'string', '276383X901X31457' => 'string', '276383X901X314581' => 'string', '276383X901X314582' => 'string', '276383X901X314583' => 'string', '276383X902X31459' => 'string', '276383X902X314601' => 'string', '276383X902X314602' => 'string', '276383X902X314603' => 'string', '276383X902X314604' => 'string', '276383X902X31461' => 'string', '276383X902X31462' => 'string', '276383X902X314631' => 'string', '276383X902X314632' => 'string', '276383X903X31464' => 'string', '276383X903X314651' => 'string', '276383X903X314652' => 'string', '276383X903X31466' => 'string', '276383X903X31489' => 'string', '276383X903X31468' => 'string', '276383X903X314691' => 'string', '276383X903X314692' => 'string', '276383X903X314693' => 'string', '276383X903X31470' => 'string', '276383X903X314711' => 'string', '276383X903X314712' => 'string', '276383X903X314713' => 'string', '276383X903X31472' => 'string', '276383X903X314731' => 'string', '276383X903X314732' => 'string', '276383X903X31474' => 'string', '276383X903X314751' => 'string', '276383X903X314752' => 'string', '276383X903X31467' => 'string', '276383X903X31476' => 'string', '276383X903X314771' => 'string', '276383X903X314772' => 'string', '276383X904X31478' => 'string', '276383X904X314791' => 'string', '276383X904X314792' => 'string', '276383X904X314793' => 'string', '276383X904X31480' => 'string', '276383X904X314811' => 'string', '276383X904X314812' => 'string', '276383X904X314813' => 'string', '276383X904X314814' => 'string', '276383X904X314815' => 'string', '276383X904X31482' => 'string', '276383X904X314831' => 'string', '276383X904X314832' => 'string', '276383X904X314833' => 'string', '276383X904X314834' => 'string', '276383X905X31484' => 'string', '276383X905X314851' => 'string', '276383X905X314852' => 'string', '276383X905X31490' => 'string', '276383X905X314911' => 'string', '276383X905X314912' => 'string', '276383X906X31487' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
