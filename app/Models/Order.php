<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'order_date'];

    protected $with = ['order_items', 'user', 'customer'];


    /**
     * Undocumented function
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    public function setOrderDateAttribute($value)
    {
        $this->attributes['order_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    // public function getOrderDateAttribute()
    // {
    //     return $this->order_date->format('d.m.Y');
    // }
}
