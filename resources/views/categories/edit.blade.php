@php
    $route = ['categories.update', 0];
    $method = 'PUT';
    $buttonText = 'Edit';
    $buttonClass = 'btn btn-success';
    $inputsOptions = ['class'=>'form-control'];
@endphp

<!-- Modal Edit -->
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            @include('categories.form')
        </div>
    </div>
</div>
<!--End of Modal Edit -->