@extends('front.layouts.main')
@section('content')
    @if (session('department_id') == 5 || session('department_id') == 8)
        <div style="top: 150px; left: 300px; width:75%;">
            <div class="row mt-5">
                <div class="col-md-6">
                    <!-- Profil Bilgileri -->
                    <div class="card">

                        <div class="card-body">
                            <img src="{{ $imageLink }}" alt="{{ $n }}" class="mb-3" style="max-width: 100%;">
                            <p><strong>Name:</strong> {{ $n }}</p>
                            <p><strong>Phone Number:</strong> {{ $phone_number }}</p>
                            <p><strong>Department:</strong> {{ $department->department_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Şifre Değiştirme Formu -->
                    <div class="card">
                        <div class="card-header">
                            Change Password
                        </div>
                        <div class="card-body">
                            <form action="{{ route('changePassword') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">Current Password:</label>
                                    <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">New Password:</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">New Password (Again):</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('department_id') == 1)
        <div style="top: 150px; left: 300px; width:75%; margin-top:15px">


            <div class="row">
                @foreach ($employees as $employee)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="{{ $employee->image->image_link }}" class="card-img-top"
                                alt="{{ $employee->employee_name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $employee->employee_name }} {{ $employee->employee_surname }}</h5>
                                <h5 class="card-title">{{ $employee->employee_id }} </h5>
                                <h5 class="card-title">${{ $employee->salary }} </h5>

                                <p class="card-text">{{ $employee->department->department_desc }}</p>
                                <form action="{{ route('changeSalary', ['id' => $employee->employee_id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="newSalary" class="form-label">New Salary:</label>
                                        <input type="number" class="form-control" id="newSalary" name="newSalary" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="changeSalaryButton"
                                        style="display: none;">Change Salary</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


@endsection
