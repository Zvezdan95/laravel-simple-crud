<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LegalEntity extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'tax_number',
        'registration_number',
        'bank_account_number',
    ];
    public function address(): HasOne
    {
        return $this->hasOne(Address::class); // changed from belongsTo to hasOne
    }
}
