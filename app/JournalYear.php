<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalYear extends Model
{
    protected $table = 'jurnalyear';
    protected $fillable = ['title', 'volumeNo', 'year', 'pdfLink', 'fileName'];

}
