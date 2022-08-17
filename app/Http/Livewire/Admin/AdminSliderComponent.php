<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\Withpagination;
use App\Models\Slider;
class AdminSliderComponent extends Component
{
    use Withpagination;
    public function deleteSlide($slide_id)
    {
        $slide = Slider::find($slide_id);
        unlink('images/slider/'.$slide->image); 
        $slide->delete();
        session()->flash('message','Slide has been deleted successfull!');
    }
    public function render()
    {
        $slides = Slider::paginate(10);
        return view('livewire.admin.admin-slider-component',['slides'=>$slides])->layout('layouts.base');
    }
}
