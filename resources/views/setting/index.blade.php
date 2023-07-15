@extends('layout.master')

@section('title')
    Setting
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Setting</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <form action="{{ route('setting.index') }}" method="post" class="form-setting" data-toggle="validator" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group row">
                        <label for="nama_perusahaan" class="col-lg-2 col-lg-offset-1 control-label">Nama Perusahaan:</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" required autofocus autocomplete="off">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telepon" class="col-lg-2 col-lg-offset-1 control-label">Telepon:</label>
                        <div class="col-lg-6">
                            <input type="number" name="telepon" id="telepon" class="form-control" required autocomplete="off">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-lg-2 col-lg-offset-1 control-label">Alamat:</label>
                        <div class="col-lg-6">
                            <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="path_logo" class="col-lg-2 col-lg-offset-1 control-label">Logo Perusahaan:</label>
                        <div class="col-lg-4">
                            <input type="file" name="path_logo" id="path_logo" class="form-control"
                                onchange="preview('.tampil-logo', this.files[0])">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-logo"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="path_kartu_member" class="col-lg-2 col-lg-offset-1 control-label">Kartu Member:</label>
                        <div class="col-lg-4">
                            <input type="file" name="path_kartu_member" id="path_kartu_member" class="form-control"
                                onchange="preview('.tampil-kartu-member', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-kartu-member"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diskon" class="col-lg-2 col-lg-offset-1 control-label">Diskon:</label>
                        <div class="col-lg-2">
                            <input type="number" name="diskon" id="diskon" class="form-control" required autocomplete="off">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipe_nota" class="col-lg-2 col-lg-offset-1 control-label">Tipe Nota:</label>
                        <div class="col-lg-2">
                            <select name="tipe_nota" id="tipe_nota" class="form-control" required>
                                <option value="1">Nota Kecil</option>
                                <option value="2">Nota Besar</option>
                            </select>
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
            showData();

            $('.form-setting').validator().on('submit', function(e) {
                if (! e.preventDefault()) {
                    $.ajax({
                        url: $('.form-setting').attr('action'),
                        type: $('.form-setting').attr('method'),
                        data: new FormData($('.form-setting')[0]),
                        async: false,
                        processData: false,
                        contentType: false
                    })
                    .done(response => {
                        showData();
                        toastr.success('Perubahan berhasil disimpan!');
                    })
                    .fail((errors) => {
                        toastr.error('Gagal menyimpan perubahan!');
                        return;
                    });
                }
            });
        });

        function showData() {
            $.get('{{ route('setting.show') }}')
            .done(response => {
                $('[name=nama_perusahaan]').val(response.nama_perusahaan);
                $('[name=telepon]').val(response.telepon);
                $('[name=alamat]').val(response.alamat);
                $('[name=diskon]').val(response.diskon);
                $('[name=tipe_nota]').val(response.tipe_nota);
                $('title').text(response.nama_perusahaan + ' | Pengaturan');

                let words = response.nama_perusahaan.split(' ');
                let word = '';
                words.forEach(w => {
                    word += w.charAt(0);
                });
                $('.logo-mini').text(word);
                $('.logo-lg').text(response.nama_perusahaan);

                $('.tampil-logo').html(`<img src="${response.path_logo}" width="150">`);
                // $('.tampil-logo').html(`<img src="{{ url('/') }}${response.path_logo}" width="150">`);
                $('.tampil-kartu-member').html(`<img src="${response.path_kartu_member}" width="300">`);
                // $('.tampil-kartu-member').html(`<img src="{{ url('/') }}${response.path_kartu_member}" width="300">`);
                $('[rel=icon]').attr('href', `${response.path_logo}`);
                // $('[rel=icon]').attr('href', `{{ url('/') }}${response.path_logo}`);
            })
            .fail(errors => {
                toastr.error('Gagal menampilkan data!');
                return;
            })
        }
      </script>
@endpush