<!-- Modal -->
<div class="modal fade" id="edit_comodities" data-backdrop="static" data-keyword="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statisBackdropLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="item_code">Kode Barang</label>
                                <input type="text" name="item_code" id="item_code_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Asal Perolehan</label>
                                <select name="school_operational_id" id="school_operational_id_edit" class="custom-select">
                                    <option selected>:: Pilih ::</option>
                                    @foreach ($school_operationals as $school_operational)
                                        <option value="{{ $school_operational->id }}">{{ $school_operational->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" id="name_edit" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="brand">Merek</label>
                                <input type="text" name="brand" id="brand_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date_of_purchase">Tahun Pembelian</label>
                                <input type="date" id="date_of_purchase_edit" name="date_of_purchase" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="material">Bahan</label>
                                <input type="text" name="material" id="material_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Lokasi</label>
                                <select name="comodity_locations_id" id="comodity_locations_id_edit" class="custom-select">
                                    <option selected>:: Pilih ::</option>
                                    @foreach ($comodity_locationss as $comodity_locations)
                                        <option value="{{ $comodity_locations->id }}">{{ $comodity_locations->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="condition">Kondisi Barang</label>
                                <select name="condition" id="condition_edit" class="custom-select">
                                    <option selected>:: Pilih ::</option>
                                    <option value="1">Baik</option>
                                    <option value="2">Kurang Baik</option>
                                    <option value="3">Rusak Ringan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="quantity">Kuantitas</label>
                                <input type="number" name="quantity" id="quantity_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="number" name="price" id="price_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="price_per_item">Harga Satuan</label>
                                <input type="number" name="price_per_item" id="price_per_item_edit" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="note">Keterangan</label>
                                <textarea name="note" id="note_edit" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" id="swal-update-button" class="btn btn-primary"><i class="fa fa-check-square"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
