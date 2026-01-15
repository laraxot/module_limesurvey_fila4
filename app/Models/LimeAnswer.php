<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Limesurvey\Casts\LimeLangField;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeAnswer
 *
 * @property int $aid
 * @property int $qid
 * @property string $code
 * @property int $sortorder
 * @property int $assessment_value
 * @property int $scale_id
 * @property int|string|array $answer
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read mixed $query
 * @property-read LimeAnswerL10n|null $l10n
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeAnswer extends BaseModel
{
    public $timestamps = false;

    protected $table = 'lime_answers';

    protected $primaryKey = 'aid';

    /**
     * Get the casts for the model.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'qid' => 'int',
            'sortorder' => 'int',
            'assessment_value' => 'int',
            'scale_id' => 'int',
            'answer' => LimeLangField::class,
        ];
    }

    /** @var list<string> */
    protected $fillable = [
        'qid',
        'code',
        'sortorder',
        'assessment_value',
        'scale_id',
    ];

    protected $appends = [
    ];

    /**
     * Undocumented variable.
     *
     * @var list<string>
     */
    protected $with = [
        'l10n',
    ];

    /**
     * Undocumented function.
     */
    public function l10n(): HasOne
    {
        $lang = app()->getLocale();
        /** @var class-string<Model> $class */
        $class = static::class.'L10n';
        $pk = $this->primaryKey;

        return $this->hasOne($class, $pk, $pk)
            ->where('language', $lang);
    }

    public function getQueryAttribute(): mixed
    {
        return null;
    }
}
