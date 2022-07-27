<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'account_id',
        'type',
        'amount',
        'description'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function convert()
    {
        return $this->hasOne(Convert::class);
    }
}
