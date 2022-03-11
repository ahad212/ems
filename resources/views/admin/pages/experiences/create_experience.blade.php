@extends('admin.layout')

@section('inner-content')
@section('title', 'Create Employee Experience')
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
        </div>
        <div class="create-btn">
            <a href="{{route('experience_list', request()->id)}}" class="btn btn-danger">Cancel</a>
            <button class="btn btn-primary">Create</button>
        </div>
    </form>
    @section('script')
        <script>
            let form = document.forms[0];
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let employeeInfo = {
                    employee_id: form.employee_id.value,
                    organization: form.organization.value,
                    from_date: form.from_date.value,
                    to_date: form.to_date.value,
                    organization_designation: form.organization_designation.value,
                    duties: form.duties.value,
                }
                let formdata = formData(employeeInfo);
                axios.post('/api/v1/create-experience', formdata)
                .then(res => {
                    const {data: response} = res;
                    if (response.success) {
                        Swal.fire(
                            'Great job!',
                            `${response.message}`,
                            'success'
                        ).then(res => {
                            window.location.assign(`/admin/${employeeInfo.employee_id}/experience-informations`);
                        });
                    }
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