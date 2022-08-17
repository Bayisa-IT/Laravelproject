<?php

namespace App\Http\Livewire\Admin;
use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditSliderComponent extends Component
{
    use WithFileUploads;
    public $slide_id;
    public $title;
    public $image;
    public $status;
    public $newimage;
   

    public function mount($slide_id)
    {
        $slide = Slider::find($slide_id);
        $this->slide_id = $slide->id;
        $this->title = $slide->title;
        $this->image = $slide->image;
        $this->status = $slide->status;

    }
    public function updated($fields)
    {
        $this->validateOnly($fields,[
           'title' => 'required'

          ]);
        if ($this->newimage) {
            $this->validateOnly($fields,[
                'newimage'=>'required|mimes:jpg,jpeg,png,gif'
    
            ]);
        }
    }

    public function updateSlide()
    {
        $this->validate([
            'title' => 'required'
         ]);
        if ($this->newimage) {
            $this->validate([
                'newimage'=>'required|image|mimes:jpg,jpeg,png,gif'
    
            ]);
        }

        $slide = Slider::find($this->slide_id);
        $slide->title = $this->title;
        $slide->status = $this->status;
        if($this->newimage)
        {
          unlink('images/slider/'.$slide->image); 
          $imageName = Carbon::now()->timestamp. '.'.$this->newimage->extension();
          $this->newimage->storeAs('slider',$imageName);
          $slide->image = $imageName;
        }
       
        $slide->save();
        session()->flash('message','Slide has been updated successfull!');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-slider-component')->layout('layouts.base');
    }
}
