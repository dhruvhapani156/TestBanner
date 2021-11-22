@component('admin.component.text', [
    'name' => 'name',
    'title' => 'Name',
    'value'=>null,
    'required'=>true,
    'options'=>['placeholder'=>'Enter name']
])@endcomponent
@component('admin.component.text', [
    'name' => 'email',
    'title' => 'Email',
    'value'=>null,
    'required'=>true,
    'options'=>['placeholder'=>'Enter email']
])@endcomponent
@component('admin.component.password', [
    'name' => 'password',
    'title' => 'Password',
    'value'=>null,
    'required'=>true,
    'options'=>['placeholder'=>'Enter password']
])@endcomponent
@component('admin.component.text', [
    'name' => 'contact',
    'title' => 'Contact',
    'value'=>null,
    'required'=>true,
    'options'=>['placeholder'=>'Enter contact']
])@endcomponent
{{--@component('admin.component.text', [--}}
{{--'name' => 'business',--}}
{{--'title' => 'Business',--}}
{{--'value'=>null,--}}
{{--'required'=>true,--}}
{{--'options'=>['placeholder'=>'Enter business']--}}
{{--])@endcomponent--}}

@component('admin.component.select', [
    'name' => 'business',
    'title' => 'Business',
    'lists' => \App\Model\Business::get()->pluck('name','name'),
    'value'=>null,
    'required'=>true,
    'options'=>['placeholder'=>'Enter business']
])@endcomponent

@component('admin.component.file', [
    'name' => 'image',
    'title' => 'image',
    'value'=>null,
    'required'=>true,
    'options'=>['placeholder'=>'Choose image']
])@endcomponent

@if(!empty($record['image_url']))
    <img src="{{ $record['image_url'] }}" width="150">
@endif

