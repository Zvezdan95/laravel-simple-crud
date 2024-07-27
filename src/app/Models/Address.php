<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'postal_code',
        'city',
        'address',
        'contact_name',
        'contact_phone',
        'address_type'
    ];

    // Relationship to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Country (if you have a Country model)
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function legalEntity(): BelongsTo|null
    {
        return $this->belongsTo(LegalEntity::class);
    }
}
