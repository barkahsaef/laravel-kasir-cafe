@extends('layouts.master')
@section('title-page', 'Log aktifitas')
@push('css')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @if ($data->isNotEmpty())
                    <div class="card-header">
                        <a href="javascript:void(0);" class="btn btn-danger rounded-0 delete"><i class="fas fa-trash"></i>
                            Hapus
                            semua log</a>
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Waktu</th>
                                    <th>Nama kasir</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $no => $item)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->tgl_aktifitas)->locale('id')->isoFormat('LLLL a') }}
                                        </td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.myTable').DataTable({
                    "language": {
                        url: "{{ asset('node_modules/datatables/plugins/id.json') }}"
                    }
                });
            });
        </script>
        <script>
            $('.delete').click(function(e) {
                e.preventDefault();
                var url = "{{ route('admin.aktifitas.delete') }}";
                swal({
                        title: 'Apakah kamu yakin?',
                        text: 'Kamu akan menghapus semua log',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = url;
                        }
                    });
            });
        </script>
        @if (Session::has('success'))
            <script>
                swal('Berhasil', '{{ Session::get('success') }}', 'success');
            </script>
        @endif
    @endpush
@endsection
