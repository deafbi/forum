<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;

class UserRegistrationChart extends Component
{
    public function render()
    {
        $userRegistrations = User::selectRaw("DATE(created_at) as date, COUNT(*) as count")
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $userRegistrations->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        });

        $data = $userRegistrations->pluck('count');

        return view('livewire.user-registration-chart', [
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
