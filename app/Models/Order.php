<?php

namespace App\Models;

use Carbon\Carbon;
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

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'date:d.m.Y',
        'notified' => 'boolean'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Undocumented variable
     *
     * @var array
     */
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

    /**
     * Undocumented function
     *
     * @return void
     */
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

    /**
     * Undocumented function
     *
     * @return void
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function setOrderDateAttribute($value)
    {
        $this->attributes['order_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function setDeliveryDateAttribute($value)
    {
        $this->attributes['delivery_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getDeliveryTypeAttribute()
    {
        return ucfirst($this->attributes['delivery_type']);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    // public function getOrderDateAttribute()
    // {
    //     return Carbon::parse($this->attributes['order_date'])->format('d.m.Y');
    // }

    /**
     * Undocumented function
     *
     * @return void
     */
    // public function getDeliveryDateAttribute()
    // {
    //     return Carbon::parse($this->attributes['delivery_date'])->format('d.m.Y');
    // }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getOrderFromAttribute()
    {
        return ucfirst($this->attributes['order_from']);
    }
}
