<?php

namespace App\Exports;

use App\Models\students;
use Maatwebsite\Excel\Concerns\FromCollection;

class studentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return students::all();
    }
}
