<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurvey254378
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
class LimeSurvey254378 extends BaseModel implements LimeSurveyXXXContract
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_survey_254378';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'token', 'submitdate', 'lastpage', 'startlanguage', 'seed', '254378X899X31376', '254378X899X31373', '254378X899X31374', '254378X889X313541_SQ001', '254378X889X313541_SQ002', '254378X889X313542_SQ001', '254378X889X313542_SQ002', '254378X889X313543_SQ001', '254378X889X313543_SQ002', '254378X889X313544_SQ001', '254378X889X313544_SQ002', '254378X889X313545_SQ001', '254378X889X313545_SQ002', '254378X889X313546_SQ001', '254378X889X313546_SQ002', '254378X889X313547_SQ001', '254378X889X313547_SQ002', '254378X890X31355', '254378X892X31360', '254378X892X313611', '254378X892X313612', '254378X892X313613', '254378X892X313614', '254378X892X313615', '254378X892X313616', '254378X892X31361other', '254378X892X3136211_SQ001', '254378X892X3136211_SQ002', '254378X892X3136212_SQ001', '254378X892X3136212_SQ002', '254378X892X3136213_SQ001', '254378X892X3136213_SQ002', '254378X892X3136214_SQ001', '254378X892X3136214_SQ002', '254378X892X3136215_SQ001', '254378X892X3136215_SQ002', '254378X893X31363', '254378X893X313641', '254378X893X313642', '254378X893X313643', '254378X893X31364other', '254378X893X3136513_SQ001', '254378X893X3136513_SQ002', '254378X893X3144113_SQ001', '254378X893X3144113_SQ002', '254378X894X31366', '254378X894X3136713_SQ001', '254378X894X3136713_SQ002', '254378X896X31369SQ001', '254378X896X31369SQ002', '254378X896X31369SQ003', '254378X896X31369SQ004', '254378X896X31369SQ005', '254378X896X31369SQ006', '254378X896X31369SQ007', '254378X896X31369SQ008', '254378X896X31369other', '254378X898X31371', '254378X898X31372', '254378X898X31377',
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
        'id' => 'int', 'token' => 'string', 'submitdate' => 'datetime', 'lastpage' => 'int', 'startlanguage' => 'string', 'seed' => 'string', '254378X899X31376' => 'string', '254378X899X31373' => 'string', '254378X899X31374' => 'string', '254378X889X313541_SQ001' => 'string', '254378X889X313541_SQ002' => 'string', '254378X889X313542_SQ001' => 'string', '254378X889X313542_SQ002' => 'string', '254378X889X313543_SQ001' => 'string', '254378X889X313543_SQ002' => 'string', '254378X889X313544_SQ001' => 'string', '254378X889X313544_SQ002' => 'string', '254378X889X313545_SQ001' => 'string', '254378X889X313545_SQ002' => 'string', '254378X889X313546_SQ001' => 'string', '254378X889X313546_SQ002' => 'string', '254378X889X313547_SQ001' => 'string', '254378X889X313547_SQ002' => 'string', '254378X890X31355' => 'string', '254378X892X31360' => 'string', '254378X892X313611' => 'string', '254378X892X313612' => 'string', '254378X892X313613' => 'string', '254378X892X313614' => 'string', '254378X892X313615' => 'string', '254378X892X313616' => 'string', '254378X892X31361other' => 'string', '254378X892X3136211_SQ001' => 'string', '254378X892X3136211_SQ002' => 'string', '254378X892X3136212_SQ001' => 'string', '254378X892X3136212_SQ002' => 'string', '254378X892X3136213_SQ001' => 'string', '254378X892X3136213_SQ002' => 'string', '254378X892X3136214_SQ001' => 'string', '254378X892X3136214_SQ002' => 'string', '254378X892X3136215_SQ001' => 'string', '254378X892X3136215_SQ002' => 'string', '254378X893X31363' => 'string', '254378X893X313641' => 'string', '254378X893X313642' => 'string', '254378X893X313643' => 'string', '254378X893X31364other' => 'string', '254378X893X3136513_SQ001' => 'string', '254378X893X3136513_SQ002' => 'string', '254378X893X3144113_SQ001' => 'string', '254378X893X3144113_SQ002' => 'string', '254378X894X31366' => 'string', '254378X894X3136713_SQ001' => 'string', '254378X894X3136713_SQ002' => 'string', '254378X896X31369SQ001' => 'string', '254378X896X31369SQ002' => 'string', '254378X896X31369SQ003' => 'string', '254378X896X31369SQ004' => 'string', '254378X896X31369SQ005' => 'string', '254378X896X31369SQ006' => 'string', '254378X896X31369SQ007' => 'string', '254378X896X31369SQ008' => 'string', '254378X896X31369other' => 'string', '254378X898X31371' => 'string', '254378X898X31372' => 'string', '254378X898X31377' => 'string',
    ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
