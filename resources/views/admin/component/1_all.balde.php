
// Text box 

@component('admin.component.text', [
    'name' => 'name',
    'title' => 'Name',
    'value'=>null,
    'required'=>true,
    'options'=>[]
])@endcomponent

// Select box

@component('admin.component.select', [
    'name' => 'category',
    'title' => 'select category',
    'lists' => App\Model\Category::all()->pluck('name','id'),
    'value'=>null,
    'required'=>true,
    'options'=>[]
])@endcomponent

// File Upload
@component('admin.component.file', [
    'name' => 'image',
    'title' => 'Upload Photo',
    'value'=>null,
    'required'=>true,
    'options'=>['placeholder'=>'Choose file']
])@endcomponent



