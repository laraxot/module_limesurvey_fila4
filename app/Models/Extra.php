<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use Modules\Xot\Models\BaseExtra;

/**
 * @property string $id
 * @property string $model_type
 * @property string $model_id
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes|null $extra_attributes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $deleted_by
 *
 * @property-read \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property-read \Modules\Xot\Contracts\ProfileContract|null $updater
 *
 * @method static \Modules\Limesurvey\Database\Factories\ExtraFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra whereExtraAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extra whereUpdatedBy($value)
 * @method static Builder<static>|Extra withExtraAttributes()
 *
 * @mixin \Eloquent
 */
class Extra extends BaseExtra
{
    /** @var string */
    protected $connection = 'limesurvey';
}
