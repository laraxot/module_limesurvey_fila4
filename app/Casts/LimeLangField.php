<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class LimeLangField implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * param \Illuminate\Database\Eloquent\Model $model
     */
    public function get($model, string $key, $value, array $attributes): int|string|array|null
    {
        if ($value !== null) {
            return $value;
        }

        $l10n = $model->l10n;

        if ($l10n === null) {
            return;
        }

        return $l10n->{$key};
    }

    /**
     * Prepare the given value for storage.
     *
     * param \Illuminate\Database\Eloquent\Model $model
     */
    public function set($model, string $key, $value, array $attributes): int|string|array|null
    {
        // Access to an undefined property Illuminate\Database\Eloquent\Model::$user.

        return $attributes;
    }
}
