<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes, HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date:d.m.Y',
        'notify' => 'boolean'
    ];

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

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function setOrderDateAttribute($value)
    {
        $this->attributes['order_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getDeliveryTypeAttribute()
    {
        return ucfirst($this->attributes['delivery_type']);
    }

    public function getOrderDateAttribute()
    {
        return Carbon::parse($this->attributes['order_date'])->format('d.m.Y');
    }

    public function getOrderFromAttribute()
    {
        return ucfirst($this->attributes['order_from']);
    }
}
