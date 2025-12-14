<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'categoryId',
        'amount',
        'type',
        'description',
        'transactionDate',
        // 'attachment_path',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transactionDate' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
