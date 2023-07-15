<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
      <form action="{{ route('laporan.index') }}" method="get" class="form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title fs-5">Periode Laporan</h4>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="tanggal_awal" class="col-md-3 col-md-offset-1 control-label">Tanggal Awal:</label>
                <div class="col-md-6">
                    <input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control datepicker" required autocomplete="off" autofocus value="{{ request('tanggal_awal') }}" style="border-radius: 0 !important;">
                    <span class="help-block with-errors"></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="tanggal_akhir" class="col-md-3 col-md-offset-1 control-label">Tanggal Akhir:</label>
                <div class="col-md-6">
                    <input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control datepicker" required autocomplete="off" value="{{ request('tanggal_akhir') }}" style="border-radius: 0 !important;">
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