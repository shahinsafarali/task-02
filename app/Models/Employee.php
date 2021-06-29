<?php

namespace App\Models;

use App\Casts\PaymentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'position',
        'payment_type',
        'payment_amount',
        'department_id'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'payment_type' => PaymentType::class,
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function workHours(): HasMany
    {
        return $this->hasMany(WorkHour::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getTotalPayment($startDate, $endDate)
    {
        return $this->payment_type->getAmount($startDate, $endDate);
    }

    public function getPaymentTypeNameAttribute()
    {
        return $this->payment_type->getName();
    }

}
