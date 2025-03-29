<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryResults extends Model
{
    use HasFactory;

    protected $table = 'lottery_results';
    protected $fillable = [
        'result',
        'date',
        'draw_time', 
        'tally_sheet'
    ];

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

    public function getScheduleAttribute($value)
    {   
        $str = '';

        if($value == 1) {
            $str = 'Morning';
        } else if($value == 2) {
            $str = 'Afternoon';
        } else if($value == 3) {
            $str = 'Evening';
        }

        return $str;
    }

    public function LotteryResultsWinners()
    {
        return $this->hasMany(\App\Models\LotteryResultsWinners::class);
    }

}
