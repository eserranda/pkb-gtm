@extends('layouts.master')
@push('header_comp')
    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('page_title')
    Data Role
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="header-title"><b>Data Role</b></h5>
                        <div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                Tambah Role
                            </button>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role as $d)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->description }}</td>
                                    <td>
                                        {{-- <a class="btn btn-sm btn-primary text-white" title="Edit"
                                            onclick="edit('{{ $d->id }}')"> <i class="fas fa-pencil-alt"></i></a> --}}

                                        <a class="btn btn-sm btn-danger text-white" title="Hapus"
                                            onclick="hapus('{{ $d->id }}')"> <i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('pages.roles.add')
    {{-- @include('pages.roles.edit') --}}
@endsection

@push('scripts')
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        async function edit(id) {
            fetch('/roles/findById/' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_nama_pengurus').value = data.nama_pengurus;
                    document.getElementById('edit_jabatan').value = data.jabatan;
                    document.getElementById('edit_tahun_mulai').value = data.tahun_mulai;
                    document.getElementById('edit_tahun_selesai').value = data.tahun_selesai;
                })
                .catch(error => console.error(error));
            // show modal edit
            $('#editModal').modal('show');
        }

        async function hapus(id) {
            Swal.fire({
                title: 'Hapus Data ID ' + id + '?',
                text: 'Data akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonColor: '#D85F47',
                cancelButtonColor: '#47D89C',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '/roles/destroy/' + id,
                        type: 'DELETE',
                        data: {
                            _token: csrfToken
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Data berhasil dihapus.',
                                    icon: 'success',
                                    timer: 500,
                                    timerProgressBar: true,
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Data gagal dihapus.',
                                    'error'
                                );
                            }
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush
