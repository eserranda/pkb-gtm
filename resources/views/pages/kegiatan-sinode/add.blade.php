<!-- resources/views/anggota/add.blade.php -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                <button type="button" class="close" onclick="closeModalAdd()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Image : </label>
                            <input type="file" class="form-control" id="image" name="image">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Nama Kegiatan </label>
                            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                placeholder="Nama Kegiatan">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Tempat</label>
                            <input type="text" class="form-control" id="tempat" name="tempat"
                                placeholder="Tempat">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Waktu</label>
                            <input type="text" class="form-control" id="waktu" name="waktu"
                                placeholder="Waktu">
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
                const response = await fetch('/kegiatan-sinode/store', {
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

                    const form = document.getElementById('addForm');
                    form.reset();
                    $('#datatable').DataTable().ajax.reload();
                    $('#addModal').modal('hide');
                }
            } catch (error) {
                console.error(error);
            }
        });
    </script>
@endpush
