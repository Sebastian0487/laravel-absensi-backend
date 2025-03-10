@extends('layouts.app')

@section('title', 'Attendances')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        /* Tabel responsif */
        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }

        /* Ukuran tombol di kolom Action */
        .table td .d-flex {
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        .table td .btn {
            min-width: 100px;
            margin: 5px 0; /* Jarak antar tombol */
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Attendances</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Attendances</a></div>
                    <div class="breadcrumb-item">All Attendances</div>
                </div>
            </div>
            <div class="section-body">
                <!-- Alert Error -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <h2 class="section-title">Attendances</h2>
                <p class="section-lead">
                    You can manage all Attendances, such as editing, deleting, and downloading reports.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Attendances</h4>
                                <!-- Dropdown untuk download PDF -->
                                <div class="dropdown ml-3">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="downloadFilterMenu"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-download"></i> Download PDF
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="downloadFilterMenu">
                                        <a class="dropdown-item" href="{{ route('attendances.download-filtered-pdf', 'today') }}">
                                            Download Hari Ini
                                        </a>
                                        <a class="dropdown-item" href="{{ route('attendances.download-filtered-pdf', 'this-week') }}">
                                            Download Minggu Ini
                                        </a>
                                        <a class="dropdown-item" href="{{ route('attendances.download-filtered-pdf', 'this-month') }}">
                                            Download Bulan Ini
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Form Pencarian -->
                                <div class="float-right">
                                    <form method="GET" action="{{ route('attendances.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search by user name" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <!-- Tabel Absensi -->
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Time In</th>
                                                <th>Time Out</th>
                                                <th>Latlong In</th>
                                                <th>Latlong Out</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendances as $attendance)
                                                <tr>
                                                    <td>{{ $attendance->user->name }}</td>
                                                    <td>{{ $attendance->date }}</td>
                                                    <td>{{ $attendance->time_in }}</td>
                                                    <td>{{ $attendance->time_out }}</td>
                                                    <td>{{ $attendance->latlon_in }}</td>
                                                    <td>{{ $attendance->latlon_out }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-info btn-sm">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-times"></i> Delete
                                                                </button>
                                                            </form>
                                                            <a href="{{ route('attendances.download-user-pdf', $attendance->user->id) }}" class="btn btn-success btn-sm">
                                                                <i class="fas fa-download"></i> PDF
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="float-right">
                                    {{ $attendances->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>

    <!-- Auto-hide Alert -->
    <script>
        setTimeout(function () {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500); // Hapus elemen setelah animasi
            }
        }, 5000);
    </script>
@endpush
