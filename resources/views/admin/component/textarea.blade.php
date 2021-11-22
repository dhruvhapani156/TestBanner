<div class="form-group {{ $errors->has($name) ? ' has-error' : '' }}">
    <label class="control-label">{{ $title }} {!! !empty($required) && $required==true?'<span class="text-danger">*</span>':'' !!}</label>
    {!! Form::textarea($name,$value, ['class' => 'form-control'] + $options ) !!}
    <span class="help-block" id="error_{{ $name }}"><strong>{{ $errors->first($name) }}</strong></span>
</div>