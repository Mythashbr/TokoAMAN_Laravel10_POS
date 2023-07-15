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
                <label for="name" class="col-md-4 col-md-offset-1 control-label">Nama:</label>
                <div class="col-md-6">
                    <input type="text" name="name" id="name" class="form-control" required autofocus autocomplete="off">
                    <span class="help-block with-errors"></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-md-offset-1 control-label">Email:</label>
                <div class="col-md-6">
                    <input type="email" name="email" id="email" class="form-control" required autocomplete="off" >
                    <span class="help-block with-errors"></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-md-4 col-md-offset-1 control-label">Password:</label>
                <div class="col-md-6">
                    <input type="password" name="password" id="password" class="form-control" 
                    required 
                    minlength="8">
                    <span class="help-block with-errors"></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="password_confirmation" class="col-md-4 col-md-offset-1 control-label">Konfirmasi Password:</label>
                <div class="col-md-6">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" 
                        required 
                        data-match="#password">
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