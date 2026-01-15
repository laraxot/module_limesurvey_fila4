<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimePluginSetting
 *
 * @property int $id
 * @property int $plugin_id
 * @property string|null $model
 * @property int|null $model_id
 * @property string $key
 * @property string|null $value
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimePluginSetting extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_plugin_settings';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'plugin_id', 'model', 'model_id', 'key', 'value',
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
            'id' => 'int', 'plugin_id' => 'int', 'model' => 'string', 'model_id' => 'int', 'key' => 'string', 'value' => 'string',
        ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
