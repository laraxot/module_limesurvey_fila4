<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey153279
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
class LimeSurvey153279 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_153279';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', '153279X923X317651', '153279X923X317652', '153279X923X317653', '153279X923X317654', '153279X923X317655', '153279X923X317656', '153279X923X317657', '153279X924X31774Q08', '153279X925X317759', '153279X925X3177510', '153279X925X3177511', '153279X926X3178112', '153279X926X3178113', '153279X927X31788', '153279X927X31789', '153279X927X31790', '153279X928X31791', '153279X928X31792', '153279X928X31793', '153279X929X31794', '153279X929X31795', '153279X929X31796', '153279X929X317971', '153279X929X317972', '153279X929X317973', '153279X929X317974', '153279X929X317975', '153279X929X317976', '153279X929X317977', '153279X929X317978', '153279X929X317979', '153279X929X31797other', '153279X929X31808Q23', '153279X930X31821',
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
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', '153279X923X317651' => 'string', '153279X923X317652' => 'string', '153279X923X317653' => 'string', '153279X923X317654' => 'string', '153279X923X317655' => 'string', '153279X923X317656' => 'string', '153279X923X317657' => 'string', '153279X924X31774Q08' => 'string', '153279X925X317759' => 'string', '153279X925X3177510' => 'string', '153279X925X3177511' => 'string', '153279X926X3178112' => 'string', '153279X926X3178113' => 'string', '153279X927X31788' => 'string', '153279X927X31789' => 'string', '153279X927X31790' => 'string', '153279X928X31791' => 'string', '153279X928X31792' => 'string', '153279X928X31793' => 'string', '153279X929X31794' => 'string', '153279X929X31795' => 'string', '153279X929X31796' => 'string', '153279X929X317971' => 'string', '153279X929X317972' => 'string', '153279X929X317973' => 'string', '153279X929X317974' => 'string', '153279X929X317975' => 'string', '153279X929X317976' => 'string', '153279X929X317977' => 'string', '153279X929X317978' => 'string', '153279X929X317979' => 'string', '153279X929X31797other' => 'string', '153279X929X31808Q23' => 'string', '153279X930X31821' => 'string',
    ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
