<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItems extends Model
{
    use HasFactory;

    protected $table = 'sales_items';
    protected $fillable = [
        'sales_id',
        'kabo_number',
        'gross_pay',
        'nine_percent',
        'four_percent',
        'out_pay'
    ];

    protected $hidden = [
        'sales_id',
    ];

    public $timestamps = false;

    public function Sales()
    {
        return $this->belongsTo(\App\Models\Sales::class);
    }

}
