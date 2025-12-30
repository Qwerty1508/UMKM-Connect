<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class SalesReports extends Component
{
    public $period = 'monthly';

    public function render()
    {
        // Dummy data for prototype
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $data = [500000, 750000, 1200000, 900000, 1500000, 2000000];

        if ($this->period === 'weekly') {
            $labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $data = [100000, 150000, 120000, 180000, 200000, 300000, 250000];
        }

        return view('livewire.sales-reports', [
            'chartLabels' => $labels,
            'chartData' => $data,
        ]);
    }

    #[Layout('layouts.seller-panel')] // Explicitly use seller layout if not inferred
    public function exportExcel()
    {
        // Export logic placeholder
        session()->flash('message', 'Laporan berhasil diexport (Simulasi)');
    }
}
