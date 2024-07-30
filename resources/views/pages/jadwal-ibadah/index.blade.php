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
@endpush

@section('page_title')
    Data Ibadah PKB
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center ">
                        <select class="form-control custom-select col-md-10" id="filterData">
                            <option value="" selected disabled>Pilih Kelompok</option>
                            <option value="Kelompok I">Kelompok I</option>
                            <option value="Kelompok II">Kelompok II</option>
                            <option value="Kelompok III">Kelompok III</option>
                            <option value="Kelompok IV">Kelompok IV</option>
                            <option value="Kelompok V">Kelompok V</option>
                            <option value="Kelompok VI">Kelompok VI</option>
                            <option value="Kelompok VII">Kelompok VII</option>
                            <option value="Kelompok VIII">Kelompok VIII</option>
                            <option value="Kelompok IX">Kelompok IX</option>
                            <option value="Kelompok X">Kelompok X</option>
                            <option value="Kelompok XI">Kelompok XI</option>
                            <option value="Kelompok XII">Kelompok XII</option>
                            <option value="Kelompok XIII">Kelompok XIII</option>
                            <option value="Kelompok XIV">Kelompok XIV</option>
                            <option value="Kelompok XV">Kelompok XV</option>
                            <option value="Kelompok XVI">Kelompok XVI</option>
                            <option value="Kelompok XVII">Kelompok VII</option>
                            <option value="Kelompok XVIII">Kelompok VIII</option>
                            <option value="Kelompok XIX">Kelompok IX</option>
                            <option value="Kelompok XX">Kelompok XX</option>
                            <option value="Kelompok XXI">Kelompok XXI</option>
                            <option value="Kelompok XXII">Kelompok XXII</option>
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
                            <th>Nama Anggota</th>
                            <th>Kelompok</th>
                            <th>Tanggal</th>
                            <th>Pelayan Firman</th>
                            <th>MC</th>
                            <th>Persembahan</th>
                            <th>Kolektan</th>
                            <th>Lelang</th>
                            <th>Tempat Ibadah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end row -->

    @include('pages.jadwal-ibadah.add')
    @include('pages.jadwal-ibadah.edit')
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


    <script>
        function edit(id) {
            fetch('/jadwal-ibadah/findById/' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_id_anggota_pkb').value = data.id_anggota_pkb;
                    document.getElementById('edit_kelompok').value = data.kelompok;
                    document.getElementById('edit_tanggal').value = data.tanggal;
                    document.getElementById('edit_pelayan_firman').value = data.pelayan_firman;
                    document.getElementById('edit_mc').value = data.mc;
                    document.getElementById('edit_persembahan').value = data.persembahan;
                    document.getElementById('edit_kolektan').value = data.kolektan;
                    document.getElementById('edit_lelang').value = data.lelang;
                    document.getElementById('edit_tempat_ibadah').value = data.tempat_ibadah;

                    var editIdAnggotaPkbSelect = document.getElementById('edit_id_anggota_pkb');

                    fetch('/anggota-pkb/findOne/' + data.id_anggota_pkb, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Gagal mengambil data');
                            }
                            return response.json();
                        })
                        .then(data => {
                            updateOptionsAndSelect2AnggotaPkb(editIdAnggotaPkbSelect, data.id, data.nama_anggota);
                        })
                        .catch(error => console.error('Error fetching data:', error));



                    // show modal edit
                    $('#editModal').modal('show');
                })
                .catch(error => console.error('Error fetching data:', error));
        }


        function updateOptionsAndSelect2AnggotaPkb(selectElement, id, name) {
            // Hapus semua opsi yang ada di elemen <select>
            $(selectElement).empty();

            // Tambahkan opsi baru ke elemen <select>
            var option = new Option(name, id, true, true);
            $(selectElement).append(option);

            // Perbarui tampilan Select2
            $(selectElement).trigger('change');
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
                        url: '/jadwal-ibadah/destroy/' + id,
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
                ajax: "{{ route('jadwal-ibadah.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: '#',
                        orderable: false,

                    },
                    {
                        data: 'id_anggota_pkb',
                        name: 'id_anggota_pkb',
                        orderable: false,
                    },
                    {
                        data: 'kelompok',
                        name: 'kelompok',
                        orderable: false,
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        orderable: false,
                    },
                    {
                        data: 'pelayan_firman',
                        name: 'pelayan_firman',
                        orderable: false,
                    },
                    {
                        data: 'mc',
                        name: 'mc',
                        orderable: false,
                    },
                    {
                        data: 'persembahan',
                        name: 'persembahan',
                        orderable: false,
                    },
                    {
                        data: 'kolektan',
                        name: 'kolektan',
                        orderable: false,
                    },
                    {
                        data: 'lelang',
                        name: 'lelang',
                        orderable: false,
                    },
                    {
                        data: 'tempat_ibadah',
                        name: 'tempat_ibadah',
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

            // fetch data klasis yang ada pada tabel jadwal-ibadah 

            // fetch('/jadwal-ibadah/getIdAndNameAllKlasis')
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
                datatable.ajax.url('{{ route('jadwal-ibadah.index') }}?filter=' + selectedFilter)
                    .load();
            });

            $('#reload').on('click', function() {
                $('#filterData').val('');
                datatable.ajax.url('{{ route('jadwal-ibadah.index') }}').load();
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
