<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Netping extends Model
{
    use HasFactory;
    protected $table = 'netping';

    public function bdcom()
    {
        return $this->hasOne(Bdcom::class, 'id', 'bdcom_id');
    }
}
