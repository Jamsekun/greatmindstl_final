<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Expenses extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'expenses';
    protected $fillalbe = [
        'station',
        'date',
        'total_amount'
    ];

    protected static $logAttributes  = [
        'station',
        'date',
        'total_amount'
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if(is_object(\Auth::guard(config('app.guards.web'))->user())) {
                $full_name = trim(\Auth::guard(config('app.guards.web'))->user()->UserInformation->full_name);

                if(\Str::length($full_name) == 0) {
                    $model->created_by = is_object(\Auth::guard(config('app.guards.web'))->user()) ? \Auth::guard(config('app.guards.web'))->user()->username : null;
                    $model->updated_by = NULL;
                } else {
                    $model->created_by = is_object(\Auth::guard(config('app.guards.web'))->user()) ? \Auth::guard(config('app.guards.web'))->user()->UserInformation->full_name : null;
                    $model->updated_by = NULL;
                }
            }
        });

        static::updating(function ($model) {
            if(is_object(\Auth::guard(config('app.guards.web'))->user())) {
                $full_name = trim(\Auth::guard(config('app.guards.web'))->user()->UserInformation->full_name);

                if(\Str::length($full_name) == 0) {
                    $model->updated_by = is_object(\Auth::guard(config('app.guards.web'))->user()) ? \Auth::guard(config('app.guards.web'))->user()->username : null;
                } else {
                    $model->updated_by = is_object(\Auth::guard(config('app.guards.web'))->user()) ? \Auth::guard(config('app.guards.web'))->user()->UserInformation->full_name : null;
                }
            }
        });
    }

    public function ExpensesItems()
    {
        return $this->hasMany(\App\Models\ExpensesItems::class);
    }

}
