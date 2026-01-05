<?php

declare(strict_types=1);

/**
 * Created by Reliese Model.
 */

namespace Modules\Limesurvey\Models;

use Spatie\SchemalessAttributes\SchemalessAttributes;
use Illuminate\Support\Carbon;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Limesurvey\Database\Factories\ExtraFactory;
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Models\BaseExtra;

/**
 * @property string $id
 * @property string $model_type
 * @property string $model_id
 * @property SchemalessAttributes|null $extra_attributes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property Carbon|null $deleted_at
 * @property string|null $deleted_by
 *
 * @property-read ProfileContract|null $creator
 * @property-read ProfileContract|null $updater
 *
 * @method static ExtraFactory factory($count = null, $state = [])
 * @method static Builder<static>|Extra newModelQuery()
 * @method static Builder<static>|Extra newQuery()
 * @method static Builder<static>|Extra query()
 * @method static Builder<static>|Extra whereCreatedAt($value)
 * @method static Builder<static>|Extra whereCreatedBy($value)
 * @method static Builder<static>|Extra whereDeletedAt($value)
 * @method static Builder<static>|Extra whereDeletedBy($value)
 * @method static Builder<static>|Extra whereExtraAttributes($value)
 * @method static Builder<static>|Extra whereId($value)
 * @method static Builder<static>|Extra whereModelId($value)
 * @method static Builder<static>|Extra whereModelType($value)
 * @method static Builder<static>|Extra whereUpdatedAt($value)
 * @method static Builder<static>|Extra whereUpdatedBy($value)
 * @method static Builder<static>|Extra withExtraAttributes()
 *
 * @mixin \Eloquent
 */
class Extra extends BaseExtra
{
    /** @var string */
    protected $connection = 'limesurvey';
}
