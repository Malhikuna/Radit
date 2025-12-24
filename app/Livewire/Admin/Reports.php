<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use PDF; // Dompdf facade
use App\Models\User;
use App\Models\Post;
use App\Models\Community;

class Reports extends Component
{
    public $reportType = 'users'; // default report

    public function generatePdf()
    {
        // Ambil data sesuai tipe laporan
        $data = [];
        switch ($this->reportType) {
            case 'users':
                $data = User::all();
                break;
            case 'posts':
                $data = Post::all();
                break;
            case 'communities':
                $data = Community::all();
                break;
        }

        $pdf = PDF::loadView('livewire.admin.pdf-report', [
            'data' => $data,
            'type' => ucfirst($this->reportType)
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            $this->reportType . '_report_' . now()->format('Ymd_His') . '.pdf'
        );
    }

    public function render()
    {
        return view('livewire.admin.reports')->layout('layouts.admin');
    }
}
