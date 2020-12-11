<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
    protected $guarded = [];
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');  
    }


    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }
}
