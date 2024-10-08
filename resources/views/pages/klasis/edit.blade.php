<!-- resources/views/anggota/add.blade.php -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Tambah Data Klasis</h5>
                <button type="button" class="close" onclick="closeModalEdit()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Nama Klasis
                                <span class="text-danger">*</span>
                            </label>
                            <input type="hidden" class="form-control" id="edit_id" name="id">
                            <input type="text" class="form-control" id="edit_nama_klasis" name="edit_nama_klasis"
                                placeholder="Nama Klasis">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Wilayah : </label>
                            <select class="form-control custom-select" name="edit_wilayah" id="edit_wilayah">
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
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Koordinator</label>
                            <input type="text" class="form-control" name="edit_koordinator" id="edit_koordinator"
                                placeholder="Koordinator">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">No Telp.</label>
                            <input type="number" class="form-control" name="edit_no_telp" id="edit_no_telp"
                                placeholder="No Telp.">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-light waves-effect mr-2"
                            onclick="closeModalEdit()">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
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
                const response = await fetch('/klasis/update', {
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
