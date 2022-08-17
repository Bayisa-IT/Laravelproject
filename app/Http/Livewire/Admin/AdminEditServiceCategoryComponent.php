<?php
namespace App\Http\Livewire\Admin;
use Illuminate\Support\Str;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
class AdminEditServiceCategoryComponent extends Component
{
    use WithFileUploads;
    public $category_id;
    public $name;
    public $slug;
    public $image;
    public $newImage;
    public $featured;
    
    public function mount($category_id)
    {
        $scategory = ServiceCategory::find($category_id);
        $this->category_id = $scategory->id;
        $this->name = $scategory->name;
        $this->slug = $scategory->slug;
        $this->image = $scategory->image;
        $this->featured = $scategory->featured;

    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name,'-');

    }

    public function updated($fields)
    {
     $this->validateOnly($fields,[
         'name'=>'required',
         'slug'=>'required',
        
     ]);
     if ($this->newImage) {
        $this->validateOnly($fields,[
            'newImage'=>'required|image|mimes:jpg,jpeg,png,gif'

        ]);
    }

    
    }


   public function updateServiceCategory()
   {
    $this->validate([
        'name'=>'required',
        'slug'=>'required',
       

    ]);

    if ($this->newImage) {
        $this->validate([
            'newImage'=>'required|image|mimes:jpg,jpeg,png,gif'

        ]);
    }

    $scategory = ServiceCategory::find($this->category_id);
        $scategory->name = $this->name;
        $scategory->slug = $this->slug;
         if($this->newImage)
         {
            $imageName = Carbon::now()->timestamp. '.' . $this->newImage->extension();
            $this->newImage->storeAs('categories',$imageName);
            $scategory->image = $imageName;
           
         }
         $scategory->featured =$this->featured;
         $scategory->save();
         session()->flash('message','category has been updated successfull!');
   }


    public function render()
    {
        return view('livewire.admin.admin-edit-service-category-component')->layout('layouts.base');
    }
}
