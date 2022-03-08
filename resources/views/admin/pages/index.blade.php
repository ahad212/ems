@extends('admin.layout')

@section('inner-content')
    @section('style')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    @endsection
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Roll</th>
                <th>Phone</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Department</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
    </table>

    @section('script')
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready( function () {
                $('#table_id').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "http://127.0.0.1:8000/api/v1/employe-list",
                    },
                    columns: [
                        {'data': 'id'},
                        {'data': 'roll'},
                        {'data': 'phone'},
                        {'data': 'name'},
                        {'data': 'email'},
                        {'data': 'designation'},
                        {'data': 'department'},
                    ]
                });
            });
            axios.get('http://127.0.0.1:8000/api/v1/employe-list')
            .then(res => {
                console.log(res.data.data);
            });
        </script>
        @endsection
@endsection