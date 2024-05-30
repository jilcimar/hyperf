<?php declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class Payment extends Model
{
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected array $hidden = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'pix_qr_code',
        'transaction_identification',
        'status',
        'amount',
        'description',
        'response',
        'canceled_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
