@extends('admin.layout')

@section('inner-content')
    @section('title', 'Employee Profile')
    @section('style')
        <style>
            .custom-container {
                max-width: 600px;
                overflow: visible;
            }
            table tbody tr td {
                white-space: nowrap;
            }
        </style>
    @endsection
    <input type="hidden" id="empId" value="{{request()->id}}">

    <div class="row">
        <div class="col" id="personalInfo">
            {{-- injected from js --}}
        </div>
    </div>
    <div class="row" id="educationalInfo">
        <hr>
        <div class="col">
            <h5>Educational Information</h5>
            <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Exam</th>
                        <th>Institution</th>
                        <th>Result</th>
                        <th>Passing Year</th>
                    </tr>
                </thead>
                <tbody id="educationTbody">
                    {{-- injected from js --}}
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" id="experienceInfo">
        <hr>
        <div class="col">
            <h5>Experience Information</h5>
            <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Organization</th>
                        <th>Designation</th>
                        <th>Duties</th>
                        <th>From Date</th>
                        <th>To Date</th>
                    </tr>
                </thead>
                <tbody id="experienceTbody">
                    {{-- injected from js --}}
                </tbody>
            </table>
        </div>
    </div>

@section('script')
    <script>
        const employee_id = document.getElementById('empId').value;
        window.onload = async function() {
            const {data: employee} = await axios.get(`/api/v1/employee_profile/${employee_id}`);
            console.log(employee);
            // profile info
            if (employee) {
                let pHeadNode = document.createElement('h5');
                pHeadNode.innerText = 'personal information';
                let pHrNode = document.createElement('hr');
                let pNameNode = document.createElement('p');
                let pEmailNode = document.createElement('p');
                let pPhoneNode = document.createElement('p');
                let pRollNode = document.createElement('p');
                let pDepartmentNode = document.createElement('p');
                let pDesignationNode = document.createElement('p');

                pNameNode.innerHTML = `<strong>Name</strong>: ${employee.name}`;
                pEmailNode.innerHTML = `<strong>Email</strong>: ${employee.email}`;
                pPhoneNode.innerHTML = `<strong>Phone</strong>:  ${employee.phone}`;
                pRollNode.innerHTML = `<strong>Roll</strong>:  ${employee.roll}`;
                pDepartmentNode.innerHTML = `<strong>Department</strong>:  ${employee.department}`;
                pDesignationNode.innerHTML = `<strong>Designation</strong>:  ${employee.designation}`;

                document.getElementById('personalInfo').append(
                    pHeadNode,
                    pHrNode,
                    pNameNode, 
                    pEmailNode, 
                    pPhoneNode,
                    pRollNode,
                    pDepartmentNode,
                    pDesignationNode
                );
            }
            // educational info
            if (employee.employee_education.length) {
                let employee_education = '';
                employee.employee_education.forEach((education) => {
                    employee_education += `
                        <tr>
                            <td>${education.exam}</td>
                            <td>${education.institution}</td>
                            <td>${education.result}</td>
                            <td>${education.passing_year}</td>
                        </tr>
                    `;
                });
                document.getElementById('educationTbody').innerHTML = employee_education;
            } else {
                document.getElementById('educationalInfo').style.display = 'none';
            }

            // experience info
            if (employee.employee_experience.length) {
                let employee_experience = '';
                employee.employee_experience.forEach((experience) => {
                    employee_experience += `
                        <tr>
                            <td>${experience.organization}</td>
                            <td>${experience.designation}</td>
                            <td>${experience.duties}</td>
                            <td>${experience.from_date}</td>
                            <td>${experience.to_date}</td>
                        </tr>
                    `;
                });
                document.getElementById('experienceTbody').innerHTML = employee_experience;
            } else {
                document.getElementById('experienceInfo').style.display = 'none';
            }

        }
    </script>
@endsection

@endsection