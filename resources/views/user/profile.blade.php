@extends('layout.master')

@section('title')
    Edit Profile
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Edit Profile</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <form action="{{ route('user.update_profile') }}" method="post" class="form-profile" data-toggle="validator" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group row">
                        <label for="name" class="col-lg-3 col-lg-offset-1 control-label">Nama:</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" id="name" class="form-control" value="{{ $profile->name }}" required autofocus autocomplete="off">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-lg-3 col-lg-offset-1 control-label">Profile:</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto" id="foto" class="form-control"
                                onchange="preview('.tampil_foto', this.files[0])">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil_foto">
                                <img src="{{ url($profile->foto ?? '/') }}" width="200" alt="foto profil">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old_password" class="col-lg-3 col-lg-offset-1 control-label">Password Lama:</label>
                        <div class="col-lg-6">
                            <input type="password" name="old_password" id="old_password" class="form-control" minlength="8" autocomplete="off">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-lg-3 col-lg-offset-1 control-label">Password Baru:</label>
                        <div class="col-lg-6">
                            <input type="password" name="password" id="password" class="form-control" minlength="8" autocomplete="off">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-lg-3 col-lg-offset-1 control-label">Konfirmasi Password Baru:</label>
                        <div class="col-lg-6">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" data-match="#password" autocomplete="off">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
          </div>
        </div>
      </div>
@endsection

@push('scripts')
      <script>
        $(function() {
            $('#old_password').on('keyup', function () {
                if ($(this).val() != "") $('#password, #password_confirmation').attr('required', true);
                else $('#password, #password_confirmation').attr('required', false);
            });

            $('.form-profile').validator().on('submit', function(e) {
                if (! e.preventDefault()) {
                    $.ajax({
                        url: $('.form-profile').attr('action'),
                        type: $('.form-profile').attr('method'),
                        data: new FormData($('.form-profile')[0]),
                        async: false,
                        processData: false,
                        contentType: false
                    })
                    .done(response => {
                        $('[name=name]').val(response.name);
                        $('.tampil_foto').html(`<img src="${response.foto}" width="150">`);
                        // $('.tampil_foto').html(`<img src="{{ url('/') }}${response.foto}" width="150">`);
                        $('.img-profile').attr('src', `${response.foto}`);
                        // $('.img-profile').attr('src', `{{ url('/') }}${response.foto}`);

                        toastr.success('Perubahan berhasil disimpan!');
                    })
                    .fail((errors) => {
                        if (errors.status == 422) {
                            alert(errors.responseJSON);
                        } else {
                            toastr.error('Gagal menyimpan perubahan!');
                        }
                        return;
                    });
                }
            });
        });
      </script>
@endpush