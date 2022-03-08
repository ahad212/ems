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
            {{-- <div class="col">
                <div class="card margin-top">
                    <div class="card-body">
                        <h4>Personal Information</h4>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Arif Mahmud" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone *</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="018xxxxxxxx" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address *</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="employee@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="roll" class="form-label">Roll *</label>
                            <input type="text" name="roll" class="form-control" id="roll" placeholder="Role" required>
                        </div>
                        <div class="mb-3">
                            <label for="designation" class="form-label">Designation *</label>
                            <input type="text" name="designation" class="form-control" id="designation" placeholder="Backend Developer" required>
                        </div>
                        <div class="mb-3">
                            <label for="department" class="form-label">Department *</label>
                            <input type="text" name="department" class="form-control" id="department" placeholder="IT" required>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col">
                <div class="card margin-top padding-bottom">
                    <div class="card-body">
                        <h4>Organization Informations</h4>
                        <input type="hidden" name="employee_id" value="{{request()->id}}">
                        <div class="mb-3">
                            <label for="organization" class="form-label">Organization *</label>
                            <input type="text" name="organization" class="form-control" id="organization" placeholder="Roopokar IT" required>
                        </div>
                        <div class="mb-3">
                            <label for="from" class="form-label">From Date *</label>
                            <input type="date" name="from_date" class="form-control" id="from" required>
                        </div>
                        <div class="mb-3">
                            <label for="to" class="form-label">To Date *</label>
                            <input type="date" name="to_date" class="form-control" id="to" required>
                        </div>
                        <div class="mb-3">
                            <label for="designation" class="form-label">Designation *</label>
                            <input type="text" name="organization_designation" class="form-control" id="designation" placeholder="Developer" required>
                        </div>
                        <div class="mb-3">
                            <label for="duties" class="form-label">Duties *</label>
                            <input type="text" name="duties" class="form-control" id="duties" placeholder="Development" required>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col">
                <div class="card margin-top">
                    <div class="card-body">
                        <h4>Educational Information</h4>
                        <input type="hidden" name="employee_id" value="{{request()->id}}">
                        <div class="mb-3">
                            <label for="exam" class="form-label">Exam *</label>
                            <input type="text" name="exam" class="form-control" id="exam" placeholder="BSC" required>
                        </div>
                        <div class="mb-3">
                            <label for="passing" class="form-label">Passing Year *</label>
                            <input type="text" name="passing_year" class="form-control" id="passing" placeholder="2020" required>
                        </div>
                        <div class="mb-3">
                            <label for="result" class="form-label">Result *</label>
                            <input type="text" name="result" class="form-control" id="result" placeholder="3.23" required>
                        </div>
                        <div class="mb-3">
                            <label for="institution" class="form-label">Institution *</label>
                            <input type="text" name="institution" class="form-control" id="institution" placeholder="National University" required>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="create-btn">
            <a href="{{route('employee_list')}}" class="btn btn-danger">Cancel</a>
            <button class="btn btn-primary">Create</button>
        </div>
    </form>
    @section('script')
        <script>
            let form = document.forms[0];
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let employeeInfo = {
                    // personal info
                    // name: form.name.value,
                    // phone: form.phone.value,
                    // email: form.email.value,
                    // roll: form.roll.value,
                    // designation: form.designation.value,
                    // department: form.department.value,

                    // organizational info
                    employee_id: form.employee_id.value,
                    organization: form.organization.value,
                    from_date: form.from_date.value,
                    to_date: form.to_date.value,
                    organization_designation: form.organization_designation.value,
                    duties: form.duties.value,

                    // educational info
                    // employee_id: form.employee_id.value,
                    // exam: form.exam.value,
                    // passing_year: form.passing_year.value,
                    // result: form.result.value,
                    // institution: form.institution.value,
                }
                let formdata = formData(employeeInfo);
                axios.post('http://127.0.0.1:8000/api/v1/create-experience', formdata)
                .then(res => {
                    console.log(res);
                });
            });

            // convert object to form data
            function formData(dataObject) {
                let formdata = new FormData();
                for (const key in dataObject) {
                    formdata.append(key, dataObject[key]);
                }
                return formdata;
            }
        </script>
    @endsection
@endsection