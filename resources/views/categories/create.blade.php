@php
    $route = 'categories.store';
    $method = 'POST';
    $buttonText = 'Create';
    $buttonClass = 'btn btn-success';
    $inputsOptions = ['class'=>'form-control'];
@endphp

<!-- Modal Create -->
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create</h4>
            </div>
            @include('categories.form')
        </div>
    </div>
</div>
<!--End of Modal Create -->