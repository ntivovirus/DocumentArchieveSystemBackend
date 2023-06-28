<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    use HasFactory;

    public function correspondence()    
    {
        return $this->belongsTo(Correspondence::class);
    } 

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
