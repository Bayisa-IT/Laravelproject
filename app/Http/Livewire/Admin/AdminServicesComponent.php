<?php

namespace App\Http\Livewire\Admin;
use Livewire\Withpagination;
use App\Models\Service;
use Livewire\Component;

class AdminServicesComponent extends Component
{
    use WithPagination;

    public function deleteService($service_id)
    {
        $service = Service::find($service_id);
        if($service->image)
        {
            unlink('images/services'. '/' .$service->image);
        }
        if($service->thumbnail)
        {
            unlink('images/services/thumbnails'. '/' .$service->thumbnail);
        }
        $service->delete();
        session()->flash('message','Service has been deleted successfull!');

    }
    public function render()
    {
        $services = Service::paginate(10);
        return view('livewire.admin.admin-services-component',['services'=>$services])->layout('layouts.base');
    }
}
