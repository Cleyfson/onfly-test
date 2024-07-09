<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Despesa extends Model
{
    use HasFactory;

    protected $table = 'despesas';

    protected $fillable = ['descricao', 'data', 'user_id', 'valor'];

    protected $casts = [
        'data' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($despesa) {
            if (is_null($despesa->data)) {
                $despesa->data = Carbon::now()->toDateString();
            }
        });
    }
}
