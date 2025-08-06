<?php

namespace App\History\Traits;

use App\Models\History;
use Illuminate\Database\Eloquent\Model;

trait Historyable
{

    public static function bootHistoryable()
    {
        static::updated(function (Model $model) {
            $changes = $model->getChangesColumns($model);
            dd($changes);
        });
    }
    protected function getChangesColumns(Model $model)
    {
        $changes = array_diff(
            $model->getChanges(),
            $model->getOriginal()
        ); // array_diff($model->getChanges(), $model->getOriginal());
        return $changes;
    }




    public function histories()
    {
        return $this->morphMany(History::class, 'historyable')
            ->latest();
    }
    // public static function bootHistoryable()
    // {
    //     static::saved(function ($model) {
    //         $model->histories()->create([
    //             'change_column' => $model->getChanges(),
    //             'changed_value_from' => $model->getOriginal(),
    //             'changed_value_to' => $model->getAttributes(),
    //         ]);
    //     });
    // }
} 