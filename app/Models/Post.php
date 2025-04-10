<?php

namespace App\Models;
//umoznuje praovat s tabulkami ako s objektami
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    //ktore stlpce tabulky budu vyplnene
    protected $fillable = ['title', 'content', 'category_id', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
        
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'tag_post');
    }
}
