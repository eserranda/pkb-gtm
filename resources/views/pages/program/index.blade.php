@extends('layouts.master')

@push('header_comp')
    <!-- Sweet Alert -->
    <link href="{{ asset('assets') }}/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css datables -->
    <link href="{{ asset('assets') }}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
@endpush

@section('page_title')
    Program
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center ">
                        <select class="form-control custom-select col-md-10" id="filterBidang">
                            {{-- <h5 class="col-md-2 mx-0">Filter : </h5> --}}
                            <option value="" selected disabled>Pilih bidang</option>
                            <option value="Bidang I">Bidang I</option>
                            <option value="Bidang II">Bidang II</option>
                            <option value="Bidang III">Bidang III</option>
                            <option value="Bidang Umum Dan Kesekretariatan">Bidang Umum Dan Kesekretariatan</option>
                        </select>
                        <button type="button" class="btn btn-light waves-effect col-2 mx-1" id="reload">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20"
                                viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">`
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                            </svg>
                        </button>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-info waves-effect" id="btnPrint">Print</button>
                        <button type="button" class="btn btn-success waves-effect mx-1" id="btnExcel">Excel</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                            ADD
                        </button>
                    </div>
                </div>

                <table id="datatable" class="table table-striped table-bordered dt-responsive"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Program</th>
                            <th>Bidang</th>
                            <th>Tujuan</th>
                            <th>Bentuk</th>
                            <th>Sumber Anggaran</th>
                            <th>Penanggung Jawab</th>
                            <th>Biaya</th>
                            <th>Waktu</th>
                            <th>Tempat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end row -->

    @include('pages.program.add')
    @include('pages.program.edit')
@endsection

@push('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('assets') }}/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets') }}/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/libs/jszip/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/libs/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/libs/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables/buttons.print.min.js"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets') }}/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function edit(id) {
            fetch('/program/findById/' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_nama_program').value = data.nama_program;
                    document.getElementById('edit_bidang').value = data.bidang;
                    document.getElementById('edit_sumber_anggaran').value = data.sumber_anggaran;
                    document.getElementById('edit_penanggung_jawab').value = data.penanggung_jawab;
                    document.getElementById('edit_biaya').value = data.biaya;
                    document.getElementById('edit_tujuan').value = data.tujuan;
                    document.getElementById('edit_bentuk').value = data.bentuk;
                    document.getElementById('edit_waktu').value = data.waktu;
                    document.getElementById('edit_tempat').value = data.tempat;
                })
                .catch(error => console.error(error));
            // show modal edit
            $('#editModal').modal('show');
        }

        async function hapus(id) {
            Swal.fire({
                title: 'Hapus Data?',
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
                        url: '/program/destroy/' + id,
                        type: 'DELETE',
                        data: {
                            _token: csrfToken
                        },
                        success: function(response) {
                            console.log('Response:', response);
                            if (response.status) {
                                Swal.fire(
                                    'Terhapus!',
                                    'Data berhasil dihapus.',
                                    'success'
                                );
                                $('#datatable').DataTable().ajax.reload();

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

        var datatable;
        $(document).ready(function() {
            datatable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                responsive: true,

                dom: "<'row'<'col-lg-3'l> <'col-lg-4'B> <'col-lg-5'f>>" +
                    "<'row'<'col-sm-12 py-lg-2'tr>>" +
                    "<'row'<'col-sm-12 col-lg-5'i><'col-sm-12 col-lg-7'p>>",
                buttons: [{
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },
                        init: function(api, node, config) {
                            $(node).hide();
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },
                        init: function(api, node, config) {
                            $(node).hide();
                        }
                    },
                ],
                ajax: "{{ route('program.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: '#',
                        orderable: false,

                    },
                    {
                        data: 'nama_program',
                        name: 'nama_program',
                        orderable: false,
                    },
                    {
                        data: 'bidang',
                        name: 'bidang',
                        orderable: false,
                    },
                    {
                        data: 'tujuan',
                        name: 'tujuan',
                        orderable: false,
                    },
                    {
                        data: 'bentuk',
                        name: 'bentuk',
                        orderable: false,
                    },
                    {
                        data: 'sumber_anggaran',
                        name: 'sumber_anggaran',
                        orderable: false,
                    },
                    {
                        data: 'penanggung_jawab',
                        name: 'penanggung_jawab',
                        orderable: false,
                    },
                    {
                        data: 'biaya',
                        name: 'biaya',
                        orderable: false,
                    },
                    {
                        data: 'waktu',
                        name: 'waktu',
                        orderable: false,
                    },
                    {
                        data: 'tempat',
                        name: 'tempat',
                        orderable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $('#filterBidang').on('change', function() {
                const selectedBidang = $(this).val();
                datatable.ajax.url('{{ route('program.index') }}?bidang=' + selectedBidang)
                    .load();
            });

            $('#reload').on('click', function() {
                $('#filterBidang').val('');
                datatable.ajax.url('{{ route('program.index') }}').load();
            });
        });

        $('#btnExcel').on('click', function() {
            datatable.button('.buttons-excel').trigger();
        });

        $('#btnPrint').on('click', function() {
            datatable.button('.buttons-print').trigger();
        });
    </script>
@endpush
