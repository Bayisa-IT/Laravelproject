<?php

namespace App\Http\Livewire\Admin;
use App\Models\ServiceProvider;
use Livewire\Component;
use Livewire\Withpagination;

class AdminServiceProviderComponent extends Component
{
    use Withpagination;
    public function render()
    {
        $sproviders = ServiceProvider::paginate(10);
        return view('livewire.admin.admin-service-provider-component',['sproviders'=>$sproviders])->layout('layouts.base');
    }
}
