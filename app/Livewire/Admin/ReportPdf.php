<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Community;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportPdf extends Component
{
    public $filterRole = ''; // contoh filter users by role

    public function render()
    {
        $users = $this->filterRole 
                    ? User::where('role', $this->filterRole)->get() 
                    : User::all();

        $posts = Post::all();
        $communities = Community::all();

        return view('livewire.admin.report-pdf', compact('users','posts','communities'));
    }

    public function downloadPdf()
    {
        $users = $this->filterRole 
                    ? User::where('role', $this->filterRole)->get() 
                    : User::all();

        $posts = Post::all();
        $communities = Community::all();

        $pdf = Pdf::loadView('admin.reports.pdf', compact('users','posts','communities'))
                  ->setPaper('a4', 'landscape');

        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->stream();
        }, 'admin_report_'.date('Y-m-d').'.pdf');
    }
}
