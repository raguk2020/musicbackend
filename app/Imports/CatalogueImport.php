<?php

namespace App\Imports;

use App\Catalogue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CatalogueImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Catalogue::create([
                'author' => $row['author'],
                'title' => $row['title'],
                'subtitle' => $row['subtitle'],
                'statementOfResponsibility' => $row['statement_of_responsibility'],
                'edition' => $row['edition'],
                'placeOfPublish' => $row['place_of_pub'],
                'publisher' => $row['publisher'],
                'yearOfPublish' => $row['year_of_pub'],
                'pages' => $row['pages'],
                'notes' => $row['notes'],
                'donation' => $row['donation'],
                'subjectPersonal' => $row['subject_personal'],
                'subjectTopicsI' => $row['subject_topics_i'],
                'subjectTopicsII' => $row['subject_topics_ii'],
                'subjectPlaceI' => $row['subject_place_i'],
                'subjectPlaceII' => $row['subject_place_ii'],
                'editor' => $row['editor'],
                'shelfMark' => $row['shelf_mark'],
                'bookStatus' => 'available',
            ]);
        }
    }
}
