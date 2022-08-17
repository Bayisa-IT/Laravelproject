<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class CutomerDashboardComponent extends Component
{
    public function render()
    {
        return view('livewire.customer.cutomer-dashboard-component')->layout('layouts.base');
    }
}
