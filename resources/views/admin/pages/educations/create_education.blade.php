@extends('admin.layout')

@section('inner-content')
@section('title', 'Create Employee Education')
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
                        <h4>Educational Informations</h4>
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
            </div>
        </div>
        <div class="create-btn">
            <a href="{{route('education_list', request()->id)}}" class="btn btn-danger">Cancel</a>
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
                    exam: form.exam.value,
                    passing_year: form.passing_year.value,
                    result: form.result.value,
                    institution: form.institution.value,
                }
                let formdata = formData(employeeInfo);
                axios.post('/api/v1/create-education', formdata)
                .then(res => {
                    const {data: response} = res;
                    if (response.success) {
                        Swal.fire(
                            'Great job!',
                            `${response.message}`,
                            'success'
                        ).then(res => {
                            window.location.assign(`/admin/${employeeInfo.employee_id}/educational-informations`);
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