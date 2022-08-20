<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function detail() {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function meja() {
        return $this->belongsTo(Meja::class);
    }

    public function pelanggan() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction() {
        return $this->hasOne(Transaction::class, 'order_id', 'id');
    }
}
