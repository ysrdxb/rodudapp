<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'pickup_location',
        'delivery_location',
        'size',
        'weight',
        'pickup_time',
        'delivery_time',
        'status',
    ];    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
