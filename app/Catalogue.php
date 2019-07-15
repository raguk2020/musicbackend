<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    protected $table = 'catalogue';
    protected $fillable = ['author', 'title', 'subtitle', 'statementOfResponsibility', 'edition', 'placeOfPublish', 'publisher', 'yearOfPublish', 'pages', 'notes', 'donation', 'subjectPersonal', 'subjectTopicsI', 'subjectTopicsII', 'subjectPlaceI', 'subjectPlaceII', 'editor', 'shelfMark', 'bookStatus'];
}
