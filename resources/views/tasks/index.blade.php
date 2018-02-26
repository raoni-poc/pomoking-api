@extends('layouts.app')

@section('content')
    <div class="panel-heading">Tasks</div>
    <div class="panel-body">
        <button class="btn btn-primary" data-toggle="modal" data-target="#create">New</button>
        <hr>
        <table id="dataTable"
               class="table table-striped table-bordered table-hover table-condensed flip-content data-table-filtro-univ">
            <thead>
            <tr>
                <th>Task</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    @include('tasks.create')
    @include('tasks.edit')
    @include('tasks.destroy')
@endsection

@section('scripts-bottom')
    <script type="application/javascript">
        $(document).ready(function () {
            $('#dataTable').DataTable({
                columns: [
                    {data: 'task', name: 'task'},
                    {data: 'action', name: 'action'}
                ],
                ajax: "{{ route('tasks.dataTable') }}"
            })
        });
        function modalEdit(task){
            $('#edit').find("input[name='task']").val(task.task);
            let form = $('#edit').find('form');
            let submitUrl = form.attr('action').replace(new RegExp('/[0-9]\+'), '/'+task.id+'/');
            form.attr('action', submitUrl);
        }
        function modalDestroy(task) {
            $('#destroy').find("input[name='task']").val(task.task);
            let form = $('#destroy').find('form');
            let submitUrl = form.attr('action').replace(new RegExp('/[0-9]\+'), '/'+task.id+'/');
            form.attr('action', submitUrl);
        }
    </script>
@endsection