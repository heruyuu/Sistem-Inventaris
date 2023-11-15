@extends('layouts.template')
@section('title','Dashboard')

@section('content')
    <div class="section-header">
        <h1><i class="fa fa-home"></i> Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Dashboard</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
                    <h6 class="alert-heading text-semibold" id="greeting"></h6>
                    Welcome Aplikasi Inventaris
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-columns"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Barang</h4>
                        </div>
                        <div class="card-body">
                            {{ $comodities }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-fw fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kondisi Baik</h4>
                        </div>
                        <div class="card-body">
                            {{ $comodities_good }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-fw fa-exclamation-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kondisi Rusak Ringan</h4>
                        </div>
                        <div class="card-body">
                            {{ $comodities_notGood }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-fw fa-times-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kondisi Rusak Berat</h4>
                        </div>
                        <div class="card-body">
                            {{ $comodities_demage }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Barang Termahal</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($comodities_order as $key => $order)
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <div class="media-body">
                                        <button  data-id="{{ $order->id }}" class="float-right btn btn-info btn-sm show_modal" data-toggle="modal" data-target="#show_detail">
                                            <i class="fa fa-eye-dropper"> Detail</i>
                                        </button>
                                        <div class="media-title">{{ $order->name }}</div>
                                        <span class="text-small text-muted">
                                            Harga: Rp{{ $order->indonesian_currency($order->price) }}
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                        <div class="text-center pt-1 pb-1">
                            <a href="{{ asset('comodities') }}" class="btn btn-primary btn-lg btn-round">
                                <i class="fa fa-eye"> Lihat Semua Barang</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_internal')
    @include('pages.dashboard._script')
    @include('pages.dashboard.show')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#greeting').html(greeting());
        });
    </script>
@endpush
