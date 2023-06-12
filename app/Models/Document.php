<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public function files()
    {
        return $this->belongsTo(File::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
