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
                <div class="card margin-top padding-bottom">
                    <div class="card-body">
                        <h4>Organization Informations</h4>
                        <input type="hidden" name="experience_id" value="{{request()->experience_id}}">
                        <div class="mb-3">
                            <label for="organization" class="form-label">Organization *</label>
                            <input type="text" name="organization" class="form-control" value="{{$experience->organization}}" id="organization" placeholder="Roopokar IT" required>
                        </div>
                        <div class="mb-3">
                            <label for="from" class="form-label">From Date *</label>
                            <input type="date" name="from_date" class="form-control" value="{{$experience->from_date}}" id="from" required>
                        </div>
                        <div class="mb-3">
                            <label for="to" class="form-label">To Date *</label>
                            <input type="date" name="to_date" class="form-control" value="{{$experience->to_date}}" id="to" required>
                        </div>
                        <div class="mb-3">
                            <label for="designation" class="form-label">Designation *</label>
                            <input type="text" name="organization_designation" class="form-control" value="{{$experience->designation}}" id="designation" placeholder="Developer" required>
                        </div>
                        <div class="mb-3">
                            <label for="duties" class="form-label">Duties *</label>
                            <input type="text" name="duties" class="form-control" value="{{$experience->duties}}" id="duties" placeholder="Development" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="create-btn">
            <a href="{{route('experience_list', request()->employee_id)}}" class="btn btn-danger">Cancel</a>
            <button class="btn btn-primary">Create</button>
        </div>
    </form>
    @section('script')
        <script>
            let form = document.forms[0];
            const experience_id = form.experience_id.value;
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                axios.put(`/api/v1/experience_edit/${experience_id}`, {
                    organization: form.organization.value,
                    from_date: form.from_date.value,
                    to_date: form.to_date.value,
                    organization_designation: form.organization_designation.value,
                    duties: form.duties.value,                    
                })
                .then(res => {
                    console.log(res);
                });
            });
        </script>
    @endsection
@endsection