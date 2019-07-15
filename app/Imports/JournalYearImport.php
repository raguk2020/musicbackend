<?php

namespace App\Imports;

use App\JournalYear;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class JournalYearImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $link = $row['link'];
            $explode = explode('href=".', $link);
            $link = $explode[1];
            $explode = explode('">', $link);
            $link = $explode[0];
            $explode = $explode[1];
            $explode = explode('<', $explode);
            $fileName = $explode[0];

            JournalYear::create([
                'title' => $row['title'],
                'volumeNo' => $row['vol'],
                'year' => $row['year'],
                'pdfLink' => $link,
                'fileName' => $fileName
            ]);
        }
    }
}

