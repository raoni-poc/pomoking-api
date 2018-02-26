{{ Form::open(['route' => $route, 'method'=> $method]) }}

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <div class="col-sm-2">
                {{ Form::label('category', 'Category') }}
            </div>
            <div class="col-sm-10">
                {{ Form::text('category', null, $inputsOptions) }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::button('Close', ['class'=>'btn btn-default', 'data-dismiss'=>"modal"]) }}
    {{ Form::submit($buttonText, ['class'=>$buttonClass]) }}
</div>

{{ Form::close() }}