<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;

class SituationGeneraleExport implements FromView, WithTitle
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('situations.exports.situation', $this->data);
    }

    public function title(): string
    {
        return 'Situation Generale';
    }
}
