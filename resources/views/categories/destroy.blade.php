@php
    $route = ['categories.destroy',0];
    $method = 'DELETE';
    $buttonText = 'Delete';
    $buttonClass = 'btn btn-danger';
    $inputsOptions = ['class'=>'form-control', 'disabled'=>'disabled'];
@endphp

<!-- Modal Destroy -->
<div id="destroy" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete</h4>
            </div>
            @include('categories.form')
        </div>

    </div>
</div>
<!--End of Modal Destroy -->