<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total'];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
