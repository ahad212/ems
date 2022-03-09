@extends('admin.layout')

@section('inner-content')
    @section('style')
        <style>
            .margin-top {
                margin-top: 25px;
            }
            .padding-bottom {
                padding-bottom: 85px;
            }
            .create-btn {
                margin: 10px 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        </style>
    @endsection
    <h3>Create Employee</h3>
    <form id="create-form">
        <div class="row">
            <div class="col">
                <div class="card margin-top">
                    <div class="card-body">
                        <h4>Personal Informations</h4>
                        <input type="hidden" name="employee_id" value="{{request()->employee_id}}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" name="name" class="form-control" value="{{$employee->name}}" id="name" placeholder="Arif Mahmud" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone *</label>
                            <input type="text" name="phone" class="form-control" value="{{$employee->phone}}" id="phone" placeholder="018xxxxxxxx" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address *</label>
                            <input type="email" name="email" class="form-control" value="{{$employee->email}}" id="email" placeholder="employee@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="roll" class="form-label">Roll *</label>
                            <input type="text" name="roll" class="form-control" value="{{$employee->roll}}" id="roll" placeholder="Role" required>
                        </div>
                        <div class="mb-3">
                            <label for="designation" class="form-label">Designation *</label>
                            <input type="text" name="designation" class="form-control" value="{{$employee->designation}}" id="designation" placeholder="Backend Developer" required>
                        </div>
                        <div class="mb-3">
                            <label for="department" class="form-label">Department *</label>
                            <input type="text" name="department" class="form-control" value="{{$employee->department}}" id="department" placeholder="IT" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="create-btn">
            <a href="{{route('employee_list')}}" class="btn btn-danger">Cancel</a>
            <button class="btn btn-primary">Update</button>
        </div>
    </form>
    
    @section('script')
        <script>
            let form = document.forms[0];
            const employee_id = form.employee_id.value;
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                axios.put(`/api/v1/employee_edit/${employee_id}`, {
                    name: form.name.value,
                    phone: form.phone.value,
                    email: form.email.value,
                    roll: form.roll.value,
                    designation: form.designation.value,
                    department: form.department.value,
                })
                .then(res => {
                    const {data: response} = res;
                    if (response.success) {
                        Swal.fire(
                            'Great job!',
                            `${response.message}`,
                            'success'
                        ).then(res => {
                            window.location.assign(`/admin`);
                        });
                    }
                });
            });
        </script>
    @endsection
@endsection