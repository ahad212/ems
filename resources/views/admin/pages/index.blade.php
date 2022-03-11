@extends('admin.layout')

@section('inner-content')
@section('title', 'Employee Table')
    @section('style')
        <style>
            .margin-tb {
                margin-bottom: 10px; 
                float: right;
            }
        </style>
    @endsection
    <a class="btn btn-primary margin-tb" href="{{route('create')}}">Create Employee</a>
    <table id="table_id" class="table table-bordered display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Roll</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Informations</th>
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
                        url: "/api/v1/employe-list",
                    },
                    "columns": [
                        {'data': 'id', name: 'id'},
                        {'data': 'name', name: 'name'},
                        {'data': 'email', name: 'email'},
                        {'data': 'phone', name: 'phone'},
                        {'data': 'roll', name: 'roll'},
                        {'data': 'designation', name: 'designation'},
                        {'data': 'department', name: 'department'},
                        {'data': 'informations', name: 'informations'},
                        {'data': 'actions', name: 'actions'},
                    ]
                });
            });
            // delete employee record
            function deleteEmployee(e) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get(`/api/v1/employee_delete/${e.id}`).then(res => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(res => {
                                window.location.reload();
                            })
                        });
                    }
                })
            }
        </script>
        @endsection
@endsection