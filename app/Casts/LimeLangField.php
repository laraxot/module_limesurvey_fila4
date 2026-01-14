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
     * @return int|string|array|null
     */
    public function get($model, string $key, $value, array $attributes): int|string|array|null
    {
        if (null !== $value) {
            if (\is_array($value) || \is_string($value) || \is_int($value)) {
                return $value;
            }

            return (string) $value;
        }

        $l10n = $attributes['l10n'] ?? $model->l10n ?? null;

        if (null === $l10n) {
            return null;
        }

        $result = null;

        if (\is_array($l10n)) {
            /** @var mixed|null */
            $result = $l10n[$key] ?? null;
        } elseif (\is_object($l10n)) {
            /** @var mixed|null */
            $result = $l10n->{$key} ?? null;
        }

        if (\is_array($result) || \is_string($result) || \is_int($result)) {
            return $result;
        }

        if (null === $result) {
            return null;
        }

        return (string) $result;
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
        return $attributes;
    }
}