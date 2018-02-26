@extends('layouts.app')

@section('content')
    <div class="panel-heading">Categories</div>
    <div class="panel-body">
        <button class="btn btn-primary" data-toggle="modal" data-target="#create">New</button>
        <hr>
        <table id="dataTable"
               class="table table-striped table-bordered table-hover table-condensed flip-content data-table-filtro-univ">
            <thead>
            <tr>
                <th>Category</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    @include('categories.create')
    @include('categories.edit')
    @include('categories.destroy')
@endsection

@section('scripts-bottom')
    <script type="application/javascript">
        $(document).ready(function () {
            $('#dataTable').DataTable({
                columns: [
                    {data: 'category', name: 'category'},
                    {data: 'action', name: 'action'}
                ],
                ajax: "{{ route('categories.dataTable') }}"
            })
        });
        function modalEdit(category){
            $('#edit').find("input[name='category']").val(category.category);
            let form = $('#edit').find('form');
            let submitUrl = form.attr('action').replace(new RegExp('/[0-9]\+'), '/'+category.id+'/');
            form.attr('action', submitUrl);
        }
        function modalDestroy(category) {
            $('#destroy').find("input[name='category']").val(category.category);
            let form = $('#destroy').find('form');
            let submitUrl = form.attr('action').replace(new RegExp('/[0-9]\+'), '/'+category.id+'/');
            form.attr('action', submitUrl);
        }
    </script>
@endsection