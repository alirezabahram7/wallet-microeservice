<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static sum(string $string)
 * @method static create(array $array)
 */
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['wallet_id', 'amount', 'reference_number'];

    /**
     * @return BelongsTo
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
