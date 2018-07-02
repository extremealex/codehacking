<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{

//    use Sluggable;
//    use SluggableScopeHelpers;

    protected $fillable =
        [
            'user_id',
            'category_id',
            'photo_id',
            'title',
            'body',
        ];


//    public function sluggable()
//    {
//        return [
//            'slug'=>[
//                'source' => 'title'
//            ]
//        ];
//    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
