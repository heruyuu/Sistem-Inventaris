@extends('layouts.template')
@section('title','Data Barang')
@section('content')
    <div class="section-header">
        <h1><i class="fas fa-columns"></i> Data Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Data Barang</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Barang</h4>
                        <div class="ml-auto">
                            <a href="{{ asset('barang/print') }}" class="btn btn-danger float-right mt-3 mx-3" data-toggle="tooltip" title="Print">
                                <i class="fas fa-fw fa-print"></i>
                            </a>
                            <a href="{{ ('comodities/export') }}" class="btn btn-info float-right mt-3 mx-3" data-toggle="tooltip" title="Export Excel">
                                <i class="fa fa-file-csv"></i>
                                Export
                            </a>
                            <button type="button" class="btn btn-success float-right mt-3 mx-3" data-toggle="modal" data-target="#excel">
                                <i class="fas fa-fw fa-file-excel"></i>
                                Import
                            </button>
                            <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#comodities_create">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
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
                                                <th scope="col">Kode Barang</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Tahun Pembelian</th>
                                                <th scope="col">Kondisi</th>
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
    @include('pages.comodities.modal.create')
    @include('pages.comodities.modal.edit')
    @include('pages.comodities.modal.show')
    @include('pages.comodities.modal.import')
    @include('pages.comodities._script')
@endpush
