@extends('layouts.template')
@section('title','Data Barang')
@section('content')
    <div class="section-header">
        <h1><i class="far fa-square"></i> Dana Bos</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Dana Bos</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dana Bos</h4>
                        <div class="ml-auto">
                            <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#school_operational_create"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row px-3 py-3">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Deskripsi</th>
                                                <th scope="col">Tanggal Ditambahkan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_internal')
    @include('pages.school_operational.modal.create')
    @include('pages.school_operational.modal.edit')
    @include('pages.school_operational.modal.show')
    @include('pages.school_operational._script')
@endpush
