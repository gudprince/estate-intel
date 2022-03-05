<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'isbn',
        'number_of_pages',
        'publisher',
        'country',
        'release_date',
        'authors' 
    ];

    protected $casts =[
        'authors'=> 'array'
    ];

}
