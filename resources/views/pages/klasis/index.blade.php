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
    Data Klasis
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center ">
                        <select class="form-control custom-select col-md-10" id="filterData">
                            <option value="" selected disabled>Pilih Wilayah</option>
                            <option value="Wilayah I">Wilayah I</option>
                            <option value="Wilayah II">Wilayah II</option>
                            <option value="Wilayah III">Wilayah III</option>
                            <option value="Wilayah IV">Wilayah IV</option>
                            <option value="Wilayah V">Wilayah V</option>
                            <option value="Wilayah VI">Wilayah VI</option>
                            <option value="Wilayah VII">Wilayah VII</option>
                            <option value="Wilayah VIII">Wilayah VIII</option>
                            <option value="Wilayah IX">Wilayah IX</option>
                            <option value="Wilayah X">Wilayah X</option>
                            <option value="Wilayah XI">Wilayah XI</option>
                            <option value="Wilayah XII">Wilayah XII</option>
                        </select>
                        <button type="button" class="btn btn-light waves-effect col-3 mx-1" id="reload">
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

                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Klasis</th>
                            <th>Wilayah</th>
                            {{-- <th>Alamat</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end row -->

    @include('pages.klasis.add')
    @include('pages.klasis.edit')
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
    {{-- <script src="{{ asset('assets') }}/libs/sweetalert2/sweetalert2.min.js"></script> --}}
    {{-- <script src="{{ asset('assets') }}/js/pages/sweetalerts.init.js"></script> --}}


    <script>
        function edit(id) {
            fetch('/klasis/findById/' + id)
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
                        url: '/klasis/destroy/' + id,
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
                            columns: [0, 1, 2]
                        },
                        init: function(api, node, config) {
                            $(node).hide();
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2]
                        },
                        init: function(api, node, config) {
                            $(node).hide();
                        }
                    },
                ],
                ajax: "{{ route('klasis.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: '#',
                        orderable: false,

                    },
                    {
                        data: 'nama_klasis',
                        name: 'nama_klasis',
                        orderable: false,
                    },
                    {
                        data: 'wilayah',
                        name: 'wilayah',
                        orderable: false,
                    },
                    // {
                    //     data: 'alamat',
                    //     name: 'alamat',
                    //     orderable: false,
                    // },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $('#filterData').on('change', function() {
                const selectedFilter = $(this).val();
                datatable.ajax.url('{{ route('klasis.index') }}?filter=' + selectedFilter)
                    .load();
            });

            $('#reload').on('click', function() {
                $('#filterData').val('');
                datatable.ajax.url('{{ route('klasis.index') }}').load();
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
