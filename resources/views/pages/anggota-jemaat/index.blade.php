@extends('layouts.master')

@push('header_comp')
    <!-- Sweet Alert -->
    <link href="{{ asset('assets') }}/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css datables -->
    <link href="{{ asset('assets') }}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

    <!-- Select2 -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- Plugins css -->
    <link href="{{ asset('assets') }}/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('page_title')
    Data Anggota Jemaat
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center ">
                        {{-- <select class="form-control custom-select col-md-10" id="filterData">
                            <option value="" selected disabled>Pilih Klasis</option>

                        </select> --}}
                        {{-- <button type="button" class="btn btn-light waves-effect col-3 mx-1" id="reload">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20"
                                viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">`
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                            </svg>
                        </button> --}}
                    </div>

                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-warning  mx-1" data-toggle="modal"
                            data-target="#importModal">Import</button>
                        <button type="button" class="btn btn-info waves-effect" id="btnPrint">Print</button>
                        <button type="button" class="btn btn-success waves-effect mx-1" id="btnExcel">Excel</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                            ADD
                        </button>
                    </div>
                </div>

                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Jemaat</th>
                            <th>Nama Anggota</th>
                            <th>Gender</th>
                            <th>Alamat</th>
                            <th>Status Tempat Tinggal</th>
                            <th>No Telp</th>
                            <th>Mulai Berjemaat</th>
                            <th>Status Pernikahan</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>Pendidikan</th>
                            <th>Pekerjaan</th>
                            <th>Baptis</th>
                            <th>Sidi</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                            <th>Tgl Pernikahan</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end row -->

    @include('pages.anggota-jemaat.add')
    @include('pages.anggota-jemaat.edit')
    @include('pages.anggota-jemaat.import')
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

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets') }}/libs/dropzone/dropzone.min.js"></script>


    <script>
        function edit(id) {
            fetch('/jemaat/findById/' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_nama_klasis').value = data.nama_klasis;
                    document.getElementById('edit_wilayah').value = data.wilayah;
                    document.getElementById('edit_alamat').value = data.alamat;
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
                        url: '/jemaat/destroy/' + id,
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
                // columnDefs: [{
                //         width: '25%',
                //         targets: 0
                //     },
                //     {
                //         width: '25%',
                //         targets: 1
                //     },
                //     {
                //         width: '100%',
                //         targets: 2
                //     },
                //     {
                //         targets: '_all',
                //         className: 'dt-center'
                //     }
                // ],

                dom: "<'row'<'col-lg-3'l> <'col-lg-4'B> <'col-lg-5'f>>" +
                    "<'row'<'col-sm-12 py-lg-2'tr>>" +
                    "<'row'<'col-sm-12 col-lg-5'i><'col-sm-12 col-lg-7'p>>",
                buttons: [{
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
                        },
                        init: function(api, node, config) {
                            $(node).hide();
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
                        },
                        init: function(api, node, config) {
                            $(node).hide();
                        }
                    },
                ],
                ajax: "{{ route('anggota-jemaat.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: '#',
                        orderable: false,

                    },

                    {
                        data: 'id_jemaat',
                        name: 'id_jemaat'
                    },
                    {
                        data: 'nama_anggota',
                        name: 'nama_anggota'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'status_tempat_tinggal',
                        name: 'status_tempat_tinggal'
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp'
                    },
                    {
                        data: 'mulai_berjemaat',
                        name: 'mulai_berjemaat'
                    },
                    {
                        data: 'status_pernikahan',
                        name: 'status_pernikahan'
                    },
                    {
                        data: 'tempat_lahir',
                        name: 'tempat_lahir'
                    },
                    {
                        data: 'tgl_lahir',
                        name: 'tgl_lahir'
                    },
                    {
                        data: 'pendidikan',
                        name: 'pendidikan'
                    },
                    {
                        data: 'pekerjaan',
                        name: 'pekerjaan'
                    },
                    {
                        data: 'baptis',
                        name: 'baptis'
                    },
                    {
                        data: 'sidi',
                        name: 'sidi'
                    },
                    {
                        data: 'nama_ayah',
                        name: 'nama_ayah'
                    },
                    {
                        data: 'nama_ibu',
                        name: 'nama_ibu'
                    },
                    {
                        data: 'tgl_pernikahan',
                        name: 'tgl_pernikahan'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],



            });

            // fetch data klasis yang ada pada tabel jemaat 
            // fetch('/jemaat/getIdAndNameAllKlasis')
            //     // fetch('/klasis/getIdAndNameAllKlasis')
            //     .then(response => response.json())
            //     .then(data => {
            //         const filterData = document.getElementById('filterData');
            //         data.forEach(klasis => {
            //             const option = document.createElement('option');
            //             option.value = klasis.id_klasis;
            //             option.textContent = klasis.nama_klasis;
            //             filterData.appendChild(option);
            //         });
            //     })
            //     .catch(error => console.error('Error fetching data:', error));


            $('#filterData').on('change', function() {
                const selectedFilter = $(this).val();
                datatable.ajax.url('{{ route('jemaat.index') }}?filter=' + selectedFilter)
                    .load();
            });

            $('#reload').on('click', function() {
                $('#filterData').val('');
                datatable.ajax.url('{{ route('jemaat.index') }}').load();
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
