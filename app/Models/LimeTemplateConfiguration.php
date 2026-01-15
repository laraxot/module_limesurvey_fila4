<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Limesurvey\Database\Factories\LimeTemplateConfigurationFactory;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeTemplateConfiguration
 *
 * @method static LimeTemplateConfigurationFactory factory($count = null, $state = [])
 *
 * @property int $id
 * @property string $template_name
 * @property int|null $sid
 * @property int|null $gsid
 * @property int|null $uid
 * @property string|null $files_css
 * @property string|null $files_js
 * @property string|null $files_print_css
 * @property string|null $options
 * @property string|null $cssframework_name
 * @property string|null $cssframework_css
 * @property string|null $cssframework_js
 * @property string|null $packages_to_load
 * @property string|null $packages_ltr
 * @property string|null $packages_rtl
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeTemplateConfiguration extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_template_configuration';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'template_name', 'sid', 'gsid', 'uid', 'files_css', 'files_js', 'files_print_css', 'options', 'cssframework_name', 'cssframework_css', 'cssframework_js', 'packages_to_load', 'packages_ltr', 'packages_rtl',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
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
            'id' => 'int', 'template_name' => 'string', 'sid' => 'int', 'gsid' => 'int', 'uid' => 'int', 'files_css' => 'string', 'files_js' => 'string', 'files_print_css' => 'string', 'options' => 'string', 'cssframework_name' => 'string', 'cssframework_css' => 'string', 'cssframework_js' => 'string', 'packages_to_load' => 'string', 'packages_ltr' => 'string', 'packages_rtl' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
