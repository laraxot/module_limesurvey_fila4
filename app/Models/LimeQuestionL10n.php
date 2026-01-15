<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeQuestionL10n
 *
 * @property int $id
 * @property int $qid
 * @property string $question
 * @property string|null $help
 * @property string $language
 * @property string|null $script
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeQuestionL10n extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_question_l10ns';

    protected $fillable = [
        'qid',
        'question',
        'help',
        'script',
        'language',
    ];

    /**
     * Get the casts for the model.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'qid' => 'int',
        ];
    }
}
