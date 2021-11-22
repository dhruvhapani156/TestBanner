
    @component('admin.component.text', [
        'name' => 'name',
        'title' => 'Name',
        'value'=>null,
        'required'=>true,
        'options'=>['placeholder'=>'Enter name']
    ])@endcomponent

    @component('admin.component.datepicker', [
        'name' => 'active_from',
        'title' => 'Active form date',
        'value'=>null,
        'required'=>true,
        'options'=>['placeholder'=>'Enter name']
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

