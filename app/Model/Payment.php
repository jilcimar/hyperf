<?php declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property $id
 * @property $name
 * @property $email
 * @property $created_at
 * @property $updated_at
 */
class Payment extends Model
{
    /**
     * @var string
     */
    public string $keyType = 'string';

    /**
     * @var bool
     */
    public bool $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'id',
        'pix_qr_code',
        'transaction_identification',
        'status',
        'amount',
        'description',
        'canceled_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
