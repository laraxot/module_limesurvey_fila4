<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeParticipantAttributeNamesLang
 *
 * @property int $attribute_id
 * @property string $attribute_name
 * @property string $lang
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeParticipantAttributeNamesLang extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_participant_attribute_names_lang';

    /** @var string */
    protected $primaryKey = 'attribute_id';

    /** @var list<string> */
    protected $fillable = [
        'lang', 'attribute_name',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'attribute_id' => 'int', 'lang' => 'string', 'attribute_name' => 'string',
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
