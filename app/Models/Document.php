<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // FOR SOFTDELETE 


class Document extends Model
{
    use HasFactory;

    use SoftDeletes; 


    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class); 
    }
}
 