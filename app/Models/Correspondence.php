<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // FOR SOFTDELETE 



class Correspondence extends Model
{
    use HasFactory;

    use SoftDeletes; 


    public function files()
    {
        return $this->hasMany(File::class);
    }
    
}
 