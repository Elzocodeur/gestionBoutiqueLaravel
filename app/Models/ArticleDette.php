<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class ArticleDette extends Pivot
// {
//     protected $table = 'article_dette';

//     protected $fillable = [
//         'article_id',
//         'dette_id',
//         'qteVente',
//         'prixVente'
//     ];
// }


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDette extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'dette_id',
        'qteVente',
        'prixVente',
    ];
}
