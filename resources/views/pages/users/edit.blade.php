<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Data Users</h5>
                <button type="button" class="close" onclick="closeModalEdit()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit_name" name="edit_name">
                            <div class="invalid-feedback">

                            </div>
                        </div>
                        <!-- end col -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="username">Username</label>
                            <input type="hidden" class="form-control" id="edit_id" name="id">
                            <input type="text" class="form-control" id="edit_username" name="edit_username">
                            <div class="invalid-feedback">

                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="password">Password
                                <span class="text-danger fw-light">*tidak tersedia</span>
                            </label>
                            <input type="text" class="form-control" id="edit_password" name="edit_password"
                                value="********" readonly>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label" for="password_confirmation">Password Confirmation
                                <span class="text-danger fw-light">*tidak tersedia</span>
                            </label>
                            <input type="text" class="form-control" id="password_confirmation"
                                name="password_confirmation" value="********" readonly>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" class="form-control" id="edit_email" name="edit_email">
                            <div class="invalid-feedback">

                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="role">Role</label>
                            <div id="editRolesContainer">

                            </div>
                            <div class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-light waves-effect mx-2" onclick="closeModalEdit()">
                            Batal
                        </button>
                        <button class="btn btn-primary  " type="submit">Simpan</button>
                    </div>
                </form>
                <!-- end form -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@push('scripts')
    <script>
        $('#editModal').on('shown.bs.modal', function() {
            const id = document.getElementById('edit_id').value;
            fetch('/roles/getUserRoles/' + id)
                .then(response => response.json())
                .then(data => {
                    const user = data.user;
                    const roles = data.roles;

                    const rolesContainer = document.getElementById('editRolesContainer');
                    rolesContainer.innerHTML = ''; // Clear any existing content

                    roles.forEach(role => {
                        const div = document.createElement('div');
                        div.className = 'custom-control custom-checkbox custom-control-inline';

                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.className = 'custom-control-input';
                        checkbox.id = `edit_roles_${role.id}`;
                        checkbox.name = 'edit_roles[]';
                        checkbox.value = role.name;

                        // Check if the role is already assigned to the user
                        if (user.roles.some(userRole => userRole.id === role.id)) {
                            checkbox.checked = true;
                        }

                        const label = document.createElement('label');
                        label.className = 'custom-control-label';
                        label.htmlFor = `edit_roles_${role.id}`;
                        label.appendChild(document.createTextNode(role.name));

                        div.appendChild(checkbox);
                        div.appendChild(label);
                        rolesContainer.appendChild(div);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
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
                const response = await fetch('/users/update', {
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
