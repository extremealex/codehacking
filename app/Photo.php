<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    private $directory = '/images/';

    protected $fillable =
        [
            'file'
        ];

    public function getFileAttribute($photo)
    {
        return $this->directory . $photo;
    }
}
