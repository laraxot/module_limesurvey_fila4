<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @implements CastsAttributes<int|string|array|null, mixed>
 */
class LimeLangField implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     */
    public function get($model, $key, $value, $attributes): int|string|array|null
    {
        if ($value !== null) {
            return $value;
        }

        $l10n = $model->l10n;

        if ($l10n === null) {
            return null;
        }

        return $l10n->{$key};
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     */
    public function set($model, $key, $value, $attributes): array
    {
        // Access to an undefined property Illuminate\Database\Eloquent\Model::$user.

        return $attributes;
    }
}
