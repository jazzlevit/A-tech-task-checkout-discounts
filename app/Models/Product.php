<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Table: products
 *
 * === Columns ===
 * @property int $id
 * @property string $code
 * @property string $name
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
*/
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'price'
    ];

    protected $casts = [
        'code' => 'string',
        'name' => 'string',
        'price' => 'float'
    ];
}
