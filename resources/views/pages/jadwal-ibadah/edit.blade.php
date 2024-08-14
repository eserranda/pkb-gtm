<!-- resources/views/anggota/add.blade.php -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Tambah Data Anggota PKB</h5>
                <button type="button" class="close" onclick="closeModalEdit()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Jemaat</label>
                            <select name="edit_id_jemaat" id="edit_id_jemaat">
                            </select>
                            <div class="invalid-feedback"> </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Nama Anggota PKB</label>
                            <select name="edit_id_anggota_pkb" id="edit_id_anggota_pkb">
                            </select>
                            <div class="invalid-feedback"> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Kelompok
                                <span class="text-danger">*</span>
                            </label>
                            <input type="hidden" class="form-control" id="edit_id" name="id" readonly>
                            <input type="text" class="form-control" id="edit_kelompok" name="edit_kelompok"
                                placeholder="Kelompok" readonly>
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Tanggal
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" id="edit_tanggal" name="edit_tanggal"
                                placeholder="tanggal">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Pelayan Firman
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="edit_pelayan_firman"
                                name="edit_pelayan_firman" placeholder="Pelayang Firman">
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Master Ceremonial (MC)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="edit_mc" name="edit_mc"
                                placeholder="Master Ceremonial">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Persembahan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="edit_persembahan" name="edit_persembahan"
                                placeholder="Persembahan">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Kolektan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="edit_kolektan" name="edit_kolektan"
                                placeholder="Kolektan">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Lelang
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="edit_lelang" name="edit_lelang"
                                placeholder="Lelang">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Tempat Ibadah
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="edit_tempat_ibadah"
                                name="edit_tempat_ibadah" placeholder="Tempat Ibadah">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-light waves-effect mr-2"
                            onclick="closeModalEdit()">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#edit_id_jemaat').select2({
                theme: "bootstrap-5",
                placeholder: "Pilih Jemaat",
                // minimumInputLength: 1,
                ajax: {
                    url: '/jemaat/getAllJemaat',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            $('#edit_id_anggota_pkb').select2({
                theme: "bootstrap-5",
                placeholder: "Pilih Anggota PKB",
                // minimumInputLength: 1,
                ajax: {
                    url: '/anggota-pkb/getAllAnggota',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            $("#edit_id_anggota_pkb").on("change", async function() {
                var id = $(this).val();
                try {
                    const response = await fetch('/anggota-pkb/findById/' + id, {
                        method: 'GET',
                    });
                    const responseData = await response.json();
                    if (responseData) {
                        var kelompok = responseData.kelompok;
                        $('#edit_kelompok').val(kelompok);
                    } else {
                        throw new Error('Gagal mendapatkan data');
                    }
                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                }
            })
        });

        function closeModalEdit() {
            const invalidInputs = document.querySelectorAll('.is-invalid');
            invalidInputs.forEach(invalidInput => {
                invalidInput.value = '';
                invalidInput.classList.remove('is-invalid');
                const errorNextSibling = invalidInput.nextElementSibling;
                if (errorNextSibling && errorNextSibling.classList.contains(
                        'invalid-feedback')) {
                    errorNextSibling.textContent = '';
                }
            });

            const form = document.getElementById('editForm');
            form.reset();
            $('#editModal').modal('hide');
        }

        document.getElementById('editForm').addEventListener('submit', async (event) => {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            try {
                const response = await fetch('/jadwal-ibadah/update', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData,
                });

                const data = await response.json();
                console.log(data);
                if (!data.success) {
                    Object.keys(data.messages).forEach(fieldName => {
                        const inputField = document.getElementById(fieldName);
                        if (inputField && fieldName == 'id_klasis' || inputField &&
                            fieldName == 'id_anggota_pkb') {
                            inputField.classList.add('is-invalid');
                        } else {
                            inputField.classList.add('is-invalid');
                            if (inputField.nextElementSibling) {
                                inputField.nextElementSibling.textContent = data.messages[
                                    fieldName][0];
                            }
                        }
                    });

                    // hapus error message jika form sudah di isi
                    const validFields = document.querySelectorAll('.is-invalid');
                    validFields.forEach(validField => {
                        const fieldName = validField.id;
                        if (!data.messages[fieldName]) {
                            if (fieldName === 'id_klasis' || fieldName === 'id_anggota_pkb') {
                                validField.classList.remove('is-invalid');
                            } else {
                                validField.classList.remove('is-invalid');
                                validField.nextElementSibling.textContent = '';
                            }
                        }
                    });

                } else {
                    const invalidInputs = document.querySelectorAll('.is-invalid');
                    invalidInputs.forEach(invalidInput => {
                        invalidInput.value = '';
                        invalidInput.classList.remove('is-invalid');
                        const errorNextSibling = invalidInput.nextElementSibling;
                        if (errorNextSibling && errorNextSibling.classList.contains(
                                'invalid-feedback')) {
                            errorNextSibling.textContent = '';
                        }
                    });
                    const form = document.getElementById('editForm');
                    form.reset();
                    $('#datatable').DataTable().ajax.reload();
                    $('#editModal').modal('hide');
                }
            } catch (error) {
                console.error(error);
            }
        });
    </script>
@endpush
