<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;



class AdminEditCategoryComponent extends Component
{    
   public $category_slug;
   public $category_id;
   public $name;
   public $slug;
   public function mount($category_slug)
   {
    $this->category_slug = $category_slug;
    $category =Category::where('slug',$category_slug)->first();
    $this->category_id =$category->id;
    $this->name =$category->name;
    $this->slug =$category->slug;

   }
    public function generateslug()
    {
    
    $this->slug =Str::slug($this->name);

    }
    //defined this function to ingnore the unique validation for current editing category
    protected function category_rules()
    {
        return [
            'name' => 'required',
            'slug' => [
                'required',
                Rule::unique('categories')->ignore($this->category_id)
            ]
        ];
    }
    //liverwire hook method for validation
    public function updated($fields)
    {
        $this->validateOnly($fields, $this->category_rules());
    }
    public function updateCategory()
    {
      $this->validate($this->category_rules());
    $category =Category::find($this->category_id);
    
    $category->name =$this->name;
    $category->slug =$this->slug;
    $category->save();
    $this->dispatchBrowserEvent( 'swal:modal',[
        'type' =>'success',
        'title' =>'Category updated Successfully!',
        'text' =>'',


      ]);


    }


    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('layouts.base');
    }
}
