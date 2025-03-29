<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryResultsWinners extends Model
{
    use HasFactory;

    protected $table = 'lottery_results_winners';

    protected $fillable = [
        'lottery_results_id',
        'user_information_id',
        'amount'
    ];

    protected $hidden = [
        'lottery_results_id',
        'user_information_id'
    ];

    protected static function boot() {
       parent::boot();

        static::creating(function ($model) {
            if(is_object(\Auth::guard(config('app.guards.web'))->user())) {
                $full_name = \Auth::guard(config('app.guards.web'))->user()->UserInformation->full_name;

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
                $full_name = \Auth::guard(config('app.guards.web'))->user()->UserInformation->full_name;

                if(\Str::length($full_name) == 0) {
                    $model->updated_by = is_object(\Auth::guard(config('app.guards.web'))->user()) ? \Auth::guard(config('app.guards.web'))->user()->username : null;
                } else {
                    $model->updated_by = is_object(\Auth::guard(config('app.guards.web'))->user()) ? \Auth::guard(config('app.guards.web'))->user()->UserInformation->full_name : null;
                }
            }
        });
    }

    public function LotteryResults()
    {
        return $this->belongsTo(\App\Models\LotteryResults::class);
    }

    public function UserInformation()
    {
        return $this->belongsTo(\App\Models\UserInformation::class);
    }

}
