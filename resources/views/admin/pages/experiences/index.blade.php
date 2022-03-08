@extends('admin.layout')

@section('inner-content')
    @section('style')
        <style>
            .margin-tb {
                margin-bottom: 10px; 
                float: right;
            }
        </style>
    @endsection
    <a class="btn btn-primary margin-tb" href="{{route('create_experience', request()->id)}}">Create</a>
    <table id="table_id" class="table table-bordered display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Organization</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Designation</th>
                <th>Duties</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>

    @section('script')
        <script>
            $(document).ready( function () {
                $('#table_id').DataTable({
                    processing: true,
                    serverSide: true,
                    "language": {
                        processing: '<img src="{{ asset('images/loader.gif') }}">' 
                    },
                    ajax: {
                        url: "http://127.0.0.1:8000/api/v1/experience-list",
                    },
                    "columns": [
                        {'data': 'id', name: 'id'},
                        {'data': 'organization', name: 'organization'},
                        {'data': 'from_date', name: 'from_date'},
                        {'data': 'to_date', name: 'to_date'},
                        {'data': 'designation', name: 'designation'},
                        {'data': 'duties', name: 'duties'},
                        {'data': 'actions', name: 'actions'},
                    ]
                });
            });
        </script>
    @endsection
@endsection