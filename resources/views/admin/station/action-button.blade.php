<div class="btn-group">
    @can('Station edit')
        <a class="btn btn-sm btn-warning" href="{{route('station.edit',$row)}}" data-toggle="tooltip" title="Edit">
            <i class="fa fa-lg fa-edit"></i></a>
    @endcan
    @can('Station delete')
        <form method="POST" action="{{ route('station.destroy',$row->id) }}" class="">
            @csrf
            @method('delete')
            <input type="hidden" name="_method" value="delete">
            <button data-name="{{$row->name}}" type="submit" class="btn btn-sm btn-danger delete-confirm"
                    data-toggle="tooltip" title="Delete"><i class="fa fa-lg fa-trash"></i></button>
        </form>
    @endcan
</div>
<script>
    $('.delete-confirm').click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete ${name}?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>
