@if ($data->condition === 1)
    <td>
        <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top" title="Baik">Baik</span>
    </td>
@elseif ($data->condition === 2)
    <td>
        <span class="badge badge-pill badge-warning" data-toggle="tooltip" data-placement="top" title="Kurang Baik">Kurang Baik</span>
    </td>
@else
    <td>
        <span class="badge badge-pill badge-danger" data-toggle="tooltip" data-placement="top" title="Rusak">Rusak</span>
    </td>
@endif
