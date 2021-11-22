    @component('admin.component.text', [
        'name' => 'title',
        'title' => 'Title',
        'value'=>null,
        'required'=>true,
        'options'=>['placeholder'=>'Enter title']
    ])@endcomponent
    @component('admin.component.text', [
       'name' => 'description',
       'title' => 'Description',
       'value'=>null,
       'required'=>true,
       'options'=>['placeholder'=>'Enter description']
   ])@endcomponent

    @component('admin.component.file', [
        'name' => 'image',
        'title' => 'Upload image',
        'value'=>null,
        'required'=>true,
        'options'=>['placeholder'=>'Choose file']
    ])@endcomponent


    @if(!empty($record['image_url']))
    <img src="{{ $record['image_url'] }}" width="150">
    @endif
