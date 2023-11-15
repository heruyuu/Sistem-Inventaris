@extends('layouts.template')
@section('title','Setting')

@section('content')
    <div class="section-header">
        <h1><i class="fas fa-cog"></i> Setting</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Setting</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="row px-3 py-3">
                <div class="col-12 col-md-12 col-lg-12">
                    <form id="data_form" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <div class="col-md-3">
                                        <div class="thumbnail">
                                            <div class="thumb">
                                                @if (!empty(Auth::user()->id->foto))
                                                    <img id="view_thumbnail" src="{{ asset('/public/img_user/'. Auth::user()->id->foto) }}">
                                                @else
                                                    <img id="view_thumbnail" src="{{ asset('/assets/img/placeholder.jpg') }}">
                                                @endif
                                                <div class="caption-overflow">
                                                    <span>
                                                        <button type="button" class="btn btn-info btn-rounded btn-icon btn-file">
                                                            <i class="fa fa-search"></i>
                                                            <input type="file" name="thumbnail" id="thumbnail" accept="image/jpeg">
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-rounded btn-icon" id="remove_thumbnail"><i class="fa fa-trash"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" required>
                                </div>
                            </div>
                            <br>
                            <b>Ganti Password</b>
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label for="">New Password</label>
                                    <input type="password" name="newPassword" class="form-control" placeholder="Masukkan Password Baru">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="">New Password</label>
                                    <input type="password" name="rePassword" class="form-control" placeholder="Masukkan Ulang Password Baru">
                                </div>
                            </div>
                            <br>
                            <b>Verifikasi</b>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label for="">Password</label>
                                    <input type="text" name="password" id="password" class="form-control" placeholder="Password" required>
                                    <div class="text-muted form-text">
                                        Masukkan Password Anda Untuk Menyimpan
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_internal')
    @include('pages.dashboard._script')
    <script type="text/javascript">
        $(function() {
            btn_remove_img('thumbnail');
        })
    </script>
@endpush
