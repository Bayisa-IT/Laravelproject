<?php

namespace App\Http\Livewire\Admin;
use App\Models\ServiceCategory;
use App\Models\Service;
use Livewire\Withpagination;
use Livewire\Component;

class AdminServicesByCategoryComponent extends Component
{
    use Withpagination;
    
    public $category_slug;

    public function mount($category_slug)
    {
        $this->category_slug = $category_slug;

    }
    public function render()
    {
        $category = ServiceCategory::where('slug',$this->category_slug)->first();
        $services = Service::where('service_category_id',$category->id)->paginate(10);

        return view('livewire.admin.admin-services-by-category-component',['category_name'=>$category->name,'services'=>$services])->layout('layouts.base');
    }
}
