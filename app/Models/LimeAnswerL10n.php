<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeAnswerL10n
 *
 * @property int $id
 * @property int $aid
 * @property string $answer
 * @property string $language
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeAnswerL10n extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_answer_l10ns';

    protected $casts = [
        'aid' => 'int',
    ];

    protected $fillable = [
        'aid',
        'answer',
        'language',
    ];
}
