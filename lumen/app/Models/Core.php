<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Core extends Eloquent {
    
    protected $connection = 'mongodb';

    public function __construct(array $attributes = []){   
        parent::__construct($attributes);
    }
    
}