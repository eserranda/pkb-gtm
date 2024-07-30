<!-- resources/views/anggota/add.blade.php -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Anggota PKB</h5>
                <button type="button" class="close" onclick="closeModalAdd()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Pilih Klasis</label>
                            <select name="id_klasis" id="id_klasis">
                            </select>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Pilih Jemaat
                                <span class="text-danger">*</span>
                            </label>
                            <select name="id_jemaat" id="id_jemaat">
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Nama Anggota PKB
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota"
                                placeholder="Nama Anggota PKB">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Kelompok </label>
                            <select class="form-control custom-select" name="kelompok" id="kelompok">
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
                            <div class="invalid-feedback">

                            </div>
                        </div>

                        {{-- <div class="form-group col-md-6">
                            <label class="col-form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Alamat"></textarea>
                            <div class="invalid-feedback"></div>
                        </div> --}}
                    </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-light waves-effect mr-2"
                            onclick="closeModalAdd()">Batal</button>
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
            $('#id_klasis').select2({
                theme: "bootstrap-5",
                placeholder: "Pilih Klasis",
                // minimumInputLength: 1,
                ajax: {
                    url: '/klasis/getAllKlasis',
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


            $('#id_jemaat').select2({
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
        });

        function closeModalAdd() {
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

            const form = document.getElementById('addForm');
            form.reset();
            $('#addModal').modal('hide');
        }

        document.getElementById('addForm').addEventListener('submit', async (event) => {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            try {
                const response = await fetch('/anggota-pkb/store', {
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
                        if (inputField && fieldName == 'id_klasis' || inputField && fieldName ==
                            'id_jemaat') {
                            inputField.classList.add('is-invalid');
                            // inputField.nextElementSibling.textContent = data.messages[
                            //     fieldName][0];
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
                            if (fieldName === 'id_klasis' || fieldName === 'id_jemaat') {
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

                    $('#datatable').DataTable().ajax.reload();
                    $('#addModal').modal('hide');
                }
            } catch (error) {
                console.error(error);
            }
        });
    </script>
@endpush
