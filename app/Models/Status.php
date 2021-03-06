<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Status extends Model
{
    use HasFactory, Uuids;


    protected $fillable = [
        'name',
    ];

    public function issues($orderBy = 'DESC')
    {
        return $this->hasMany(Issue::class)
            ->with(['category', 'files', 'type'])
            ->orderBy('created_at', $orderBy)
            ->get();
    }
}
