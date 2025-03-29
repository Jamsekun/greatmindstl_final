<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Str;

class UserInformation extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'users_informations';
    protected $appends = ['full_name'];

    protected $fillable = [
        'picture',
        'employee_number',
        'nick_name',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'birthday',
        'gender',
        'telephone_number',
        'phone_number',
        'email',
        'address',
        'station',
        'field_coordinator',
        'field_supervisor',
        'position',
        'is_agent',
        'status',
        'signature'
    ];

    protected static $logAttributes  = [
        'employee_number',
        'first_name',
        'middle_name',
        'last_name',
        'position',
        'station',
        'field_coordinator',
        'field_supervisor'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function User()
    {
          return $this->belongsTo(\App\Models\User::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getMiddleNameAttribute($value)
    {
        return Str::of($value)->trim()->isNotEmpty() ? $value : ' ';
    }

    public function getPhoneNumberAttribute($value)
    {
         return Str::of($value)->trim()->isNotEmpty() ? $value : 'None';
    }

    public function getTelephoneNumberAttribute($value)
    {
         return Str::of($value)->trim()->isNotEmpty() ? $value : 'None';
    }

    public function getEmailAttribute($value)
    {
         return Str::of($value)->trim()->isNotEmpty() ? $value : 'None';
    }

    public function getStationAttribute($value)
    {
         return Str::of($value)->trim()->isNotEmpty() ? $value : 'None';
    }

    public function getFieldCoordinatorAttribute($value)
    {
         return Str::of($value)->trim()->isNotEmpty() ? $value : 'None';
    }

    public function getAddressAttribute($value)
    {
         return Str::of($value)->trim()->isNotEmpty() ? $value : 'No data';
    }

}
