<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegalEntity extends Model
{
    protected $fillable = [
        'company_name',
        'tax_number',
        'registration_number',
        'bank_account_number',
    ];
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
