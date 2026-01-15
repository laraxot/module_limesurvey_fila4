<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Support\Carbon;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeNotification
 *
 * @property int $id
 * @property string $entity
 * @property int $entity_id
 * @property string $title
 * @property string $message
 * @property string $status
 * @property int $importance
 * @property string|null $display_class
 * @property string|null $hash
 * @property Carbon|null $created
 * @property Carbon|null $first_read
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeNotification extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_notifications';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'entity', 'entity_id', 'title', 'message', 'status', 'importance', 'display_class', 'hash', 'created', 'first_read',
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
        'id' => 'int', 'entity' => 'string', 'entity_id' => 'int', 'title' => 'string', 'message' => 'string', 'status' => 'string', 'importance' => 'int', 'display_class' => 'string', 'hash' => 'string', 'created' => 'datetime', 'first_read' => 'datetime',
    ];
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
