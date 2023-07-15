<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
  <div class="modal-dialog" role="document">
    <form action="" method="post" class="form-horizontal">
      @csrf
      @method('post')

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title fs-5"></h4>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="nama" class="col-md-2 col-md-offset-1 control-label">Nama:</label>
            <div class="col-md-6">
                <input type="text" name="nama" id="nama" class="form-control" required autofocus autocomplete="off">
                <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="telepon" class="col-md-2 col-md-offset-1 control-label">Telepon:</label>
            <div class="col-md-6">
                <input type="number" name="telepon" id="telepon" class="form-control" required autocomplete="off">
                <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="alamat" class="col-md-2 col-md-offset-1 control-label">Alamat:</label>
            <div class="col-md-6">
              <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
                <span class="help-block with-errors"></span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-flat btn-primary">Simpan</button>
        </div>
      </div>

    </form>
  </div>
</div>