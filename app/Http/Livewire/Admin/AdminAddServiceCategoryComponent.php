<?php

namespace App\Http\Livewire\Admin;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\ServiceCategory;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Livewire\Component;
use Livewire\WithFileUploads;
class AdminAddServiceCategoryComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $image;
   
    public function generateSlug()
    {
       $this->slug = Str::slug($this->name,'-');
    
    }

   public function updated($fields)
   {
    $this->validateOnly($fields,[
        'name'=>'required',
        'slug'=>'required',
        'image'=>'required|image|mimes:jpg,jpeg,png,gif'
    ]);
   
   }

   public function createNewCategory(Request $request){
    $validator = Validator::make($request->all(),[
        'name'=>'required',
        'slug'=>'required',
        'image'=>'required|image|mimes:jpg,jpeg,png,gif'
    ]);
   
    $scategory = new ServiceCategory();
    $scategory->name = $this->name;
    $scategory->slug = $this->slug;
    $imageName = Carbon::now()->timestamp. '.' . $this->image->extension();
    $this->image->storeAs('categories',$imageName);
    $scategory->image = $imageName;
    $scategory->save();
    session()->flash('message','category has been created successfull!');
   }

    public function render()
    {
        return view('livewire.admin.admin-add-service-category-component')->layout('layouts.base');
    }
}
