<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = ['name', 'price', 'description'];

    protected $primary = 'id';

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
