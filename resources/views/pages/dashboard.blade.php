@extends('layouts.app')

@section('title', 'Dashboard')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <!-- Total Users -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ route('users.index') }}" class="card card-statistic-1 text-decoration-none">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalUsers }}
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Total Attendances -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ route('attendances.index') }}" class="card card-statistic-1 text-decoration-none">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Attendances</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalAttendances }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Recent Attendances -->
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Attendances</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentAttendances as $attendance)
                                            <tr>
                                                <td>{{ $attendance->user->name }}</td>
                                                <td>{{ $attendance->date }}</td>
                                                <td>{{ $attendance->time_in }}</td>
                                                <td>{{ $attendance->time_out }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No recent attendances available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                <!-- Quick Tasks -->
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Quick Tasks</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label">Review Attendance Reports</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label">Check User Attendance</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label">Prepare Meeting Agenda</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
