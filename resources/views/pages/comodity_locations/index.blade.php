@extends('layouts.template')
@section('title','Data Barang')

@section('content')
    <div class="section-header">
        <h1><i class="fas fa-th"></i> Daftar Ruang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Daftar Ruang</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Ruang</h4>
                        <div class="ml-auto">
                            <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#comodity_locations_create"><i class="fa fa-plus"></i> Add</button>
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
    @include('pages.comodity_locations.modal.create')
    @include('pages.comodity_locations.modal.edit')
    @include('pages.comodity_locations.modal.show')
    @include('pages.comodity_locations._script')
@endpush
