<!-- resources/views/anggota/add.blade.php -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Jemaat</h5>
                <button type="button" class="close" onclick="closeModalAdd()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Pilih Klasis</label>
                            <select name="id_klasis" id="id_klasis" class="form-control">
                                <option value="" selected disabled>Pilih klasis</option>
                                <div class="invalid-feedback"> </div>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Pilih Jemaat </label>
                            <select name="id_jemaat" id="id_jemaat"> </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Nama Anggota</label>
                            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota"
                                placeholder="Nama Anggota">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="" selected disabled>Pilih gender</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <div class="invalid-feedback"> </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Alamat"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Status Tempat Tinggal</label>
                            <input type="text" class="form-control" name="status_tempat_tinggal"
                                id="status_tempat_tinggal" placeholder="Status Tempat Tinggal">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">No Telp</label>
                            <input type="number" class="form-control" name="no_telp" id="no_telp"
                                placeholder="No Telp">
                            <div class="invalid-feedback"> </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Mulai Berjemaat</label>
                            <input type="date" class="form-control" name="mulai_berjemaat" id="mulai_berjemaat"
                                placeholder="Mulai Berjemaat">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Status Pernikahan</label>
                            <input type="text" class="form-control" name="status_pernikahan" id="status_pernikahan"
                                placeholder="Status Pernikahan">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                                placeholder="Tempat Lahir">
                            <div class="invalid-feedback"> </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Tgl Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                                placeholder="Tgl Lahir">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Pendidikan</label>
                            <input type="text" class="form-control" name="pendidikan" id="pendidikan"
                                placeholder="Pendidikan">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan"
                                placeholder="Pekerjaan">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Baptis</label>
                            <select name="baptis" id="baptis" class="form-control">
                                <option value="" selected disabled>Pilih Baptis</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Sidi</label>
                            <select name="sidi" id="sidi" class="form-control">
                                <option value="" selected disabled>Pilih Sidi</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" id="nama_ayah"
                                placeholder="Nama Ayah">
                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" id="nama_ibu"
                                placeholder="Nama Ibu">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="col-form-label">Tgl Pernikahan</label>
                            <input type="date" class="form-control" name="tgl_pernikahan" id="tgl_pernikahan"
                                placeholder="Tgl Pernikahan">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Keterangan</label>
                            <select name="keterangan" id="keterangan" class="form-control">
                                <option value="" selected disabled>Pilih Keterangan</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
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
                const response = await fetch('/anggota-jemaat/store', {
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
