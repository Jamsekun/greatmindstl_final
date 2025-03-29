<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesItems extends Model
{
    use HasFactory;

    protected $table = 'expenses_items';
    protected $fillable = [
        'expenses_id',
        'description',
        'amount'
    ];

    protected $hidden = [
        'expenses_id',
    ];

    public $timestamps = false;

    public function Expenses()
    {
        return $this->belongsTo(\App\Models\Expense::class);
    }

}
