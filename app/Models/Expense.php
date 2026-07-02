<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['user_id', 'amount', 'added_date', 'description', 'category_id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'added_date' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
