<!-- resources/views/anggota/add.blade.php -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Data Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Nama Program
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama_program" name="nama_program"
                                placeholder="Program">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Bidang</label>
                            <input type="text" class="form-control" id="Tujuan" placeholder="Bidang">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Tujuan</label>
                            <input type="text" class="form-control" id="Tujuan" placeholder="Tujuan">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Bentuk</label>
                            <input type="text" class="form-control" id="bentuk" name="bentuk"
                                placeholder="Bentuk">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Sumber Anggaran</label>
                            <input type="text" class="form-control" id="sumber_anggaran" name="sumber_anggaran"
                                placeholder="Sumber Anggaran">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Penanggung Jawab</label>
                            <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                                placeholder="Penanggung Jawab">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Biaya</label>
                            <input type="text" class="form-control" id="biaya" name="biaya"
                                placeholder="Sumber Anggaran">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Waktu</label>
                            <input type="text" class="form-control" id="waktu" name="waktu"
                                placeholder="Penanggung Jawab">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Tempat</label>
                            <input type="text" class="form-control" id="tempat" name="tempat"
                                placeholder="Sumber Anggaran">
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
