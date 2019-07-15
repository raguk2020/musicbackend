<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalIndex extends Model
{
    protected $table = 'journalindex';
    protected $fillable = ['author','title', 'volumeNo', 'year', 'pages', 'pdfLink', 'fileName'];
}
