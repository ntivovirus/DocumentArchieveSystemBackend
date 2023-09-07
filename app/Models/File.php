<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // FOR SOFTDELETE 



class File extends Model
{
    use HasFactory;

    use SoftDeletes; 


    public function correspondence()    
    {
        return $this->belongsTo(Correspondence::class);
    } 

    public function documents()
    { 
        return $this->hasMany(Document::class);
    }
}
