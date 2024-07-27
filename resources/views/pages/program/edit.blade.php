<!-- resources/views/anggota/add.blade.php -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Edit Data Program</h5>
                <button type="button" class="close" onclick="closeModalEdit()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Nama Program
                                <span class="text-danger">*</span>
                            </label>
                            <input type="hidden" class="form-control" id="edit_id" name="id">
                            <input type="text" class="form-control" id="edit_nama_program" name="edit_nama_program"
                                placeholder="Program">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            {{-- <label class="col-form-label">Bidang</label>
                            <input type="text" class="form-control" id="bidang" name="bidang"
                                placeholder="Bidang"> --}}
                            <label class="col-form-label">Bidang : </label>
                            <select class="form-control" name="edit_bidang" id="edit_bidang">
                                <option value="" selected disabled>Pilih bidang</option>
                                <option value="Bidang I">Bidang I</option>
                                <option value="Bidang II">Bidang II</option>
                                <option value="Bidang III">Bidang III</option>
                                <option value="Bidang Umum Dan Kesekretariatan">Bidang Umum Dan Kesekretariatan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Tujuan</label>
                            <input type="text" class="form-control" id="edit_tujuan" name="edit_tujuan"
                                placeholder="Tujuan">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Bentuk</label>
                            <input type="text" class="form-control" id="edit_bentuk" name="edit_bentuk"
                                placeholder="Bentuk">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Sumber Anggaran</label>
                            <input type="text" class="form-control" id="edit_sumber_anggaran"
                                name="edit_sumber_anggaran" placeholder="Sumber Anggaran">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Penanggung Jawab</label>
                            <input type="text" class="form-control" id="edit_penanggung_jawab"
                                name="edit_penanggung_jawab" placeholder="Penanggung Jawab">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Biaya</label>
                            <input type="text" class="form-control" id="edit_biaya" name="edit_biaya"
                                placeholder="Biaya">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Waktu</label>
                            <input type="text" class="form-control" id="edit_waktu" name="edit_waktu"
                                placeholder="Waktu">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Tempat</label>
                            <input type="text" class="form-control" id="edit_tempat" name="edit_tempat"
                                placeholder="Tempat">
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
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
                const response = await fetch('/program/update', {
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
                        if (inputField) {
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
                            validField.classList.remove('is-invalid');
                            if (validField.nextElementSibling) {
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
                    $('#editModal').modal('hide');
                }
            } catch (error) {
                console.error(error);
            }
        });
    </script>
@endpush
