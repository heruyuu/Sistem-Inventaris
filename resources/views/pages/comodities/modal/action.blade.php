<a href="{{ route('barang.print.one', $data->id) }}" class="btn btn-sm text-white btn-primary" data-toggle="tooltip" title="Print">
    <i class="fas fa-fw fa-print"></i>
</a>
<a href="javascript:void(0)" onclick="show_data({{ $data->id }})" class="btn btn-sm btn-info text-white show_modal" data-toggle="modal" data-target="#show_comodities" data-placement="top" title="Show">
    <i class="fas fa-fw fa-info"></i>
</a>
<a href="javascript:void(0)" onclick="edit_data({{ $data->id }})" data-id="{{ $data->id }}" class="btn btn-sm btn-warning text-white swal-edit-button" data-toggle="modal" data-target="#edit_comodities" data-placement="top" title="Edit">
    <i class="fas fa-fw fa-edit"></i>
</a>
<a href="javascript:void(0)" onclick="delete_data({{ $data->id }})" class="btn btn-sm btn-danger text-white swal-delete-button" data-toggle="modal" data-placement="top" title="Delete">
    <i class="fas fa-fw fa-trash-alt"></i>
</a>
