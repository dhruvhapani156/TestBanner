<div class="form-group {{ $errors->has($name) ? ' error' : '' }}">
    <label for="eventInput1">{{ $title }} {!! !empty($required) && $required==true?'<span class="text-danger">*</span>':'' !!}</label>
    {!! Form::textarea($name,$value, ['class' => 'form-control ckeditor','placeholder' => 'Enter '.strtolower($title).'..'] + $options ) !!}
    @if ($errors->has($name))
        <div class="help-block ">
            <ul role="alert ">
                <li>{{ $errors->first($name) }}</li>
            </ul>
        </div>
    @endif
</div>
