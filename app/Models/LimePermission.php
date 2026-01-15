<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimePermission
 *
 * @property int $id
 * @property string $entity
 * @property int $entity_id
 * @property int $uid
 * @property string $permission
 * @property int $create_p
 * @property int $read_p
 * @property int $update_p
 * @property int $delete_p
 * @property int $import_p
 * @property int $export_p
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimePermission extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_permissions';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'entity', 'entity_id', 'uid', 'permission', 'create_p', 'read_p', 'update_p', 'delete_p', 'import_p', 'export_p',
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
        'id' => 'int', 'entity' => 'string', 'entity_id' => 'int', 'uid' => 'int', 'permission' => 'string', 'create_p' => 'int', 'read_p' => 'int', 'update_p' => 'int', 'delete_p' => 'int', 'import_p' => 'int', 'export_p' => 'int',
    ];
    }

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
