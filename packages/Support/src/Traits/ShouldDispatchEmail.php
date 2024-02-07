<?php

namespace Package\Support\Traits;

use Illuminate\Database\Eloquent\Model;
use Package\Support\Attributes\DispatchableEmailAttribute;

trait ShouldDispatchEmail
{
    public static function bootShouldDispatchEmail(): void
    {
        static::created(function(Model $model): bool {
            array_map(
                static::dispatchEmail(...),
                (new ReflectionClass(static::class))->getAttributes(DispatchableEmailAttribute::class)
            );

            return true;
        });
    }

    private static function dispatchEmail(\ReflectionAttribute $attribute): void
    {
        /** @var DispatchableEmailAttribute $instance */
        $instance = $attribute->newInstance();

        // TODO: Pass to email and render
    }
}