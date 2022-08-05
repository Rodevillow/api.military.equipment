<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

/**
 * Emulate autoincrement to uuid
 */
trait HasUuid {

    /**
     * Emulate autoincrement to uuid
     *
     * @return void
     */
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid();
            }
        });
    }
}
