<div class="btn-group">
    @can('Punishment show')
        <a class="btn btn-sm btn-success" href="{{route('show-punishment-employee',[$row->id])}}" data-toggle="tooltip" title="Show"><i class="fa fa-lg fa-eye"></i></a>
    @endcan
    @can('Punishment edit assigned')
        <a class="btn btn-sm btn-group-sm btn-primary" href="{{route('edit-punishment-employee',[$row->id])}}" data-toggle="tooltip" title="Edit Employee Punishment"><i class="fa fa-lg fa-edit"></i></a>
    @endcan
    @can('Punishment delete assigned')
        <form method="POST" action="{{route('remove-employee-from-punishment',[$row->id])}}" class="">
            @csrf
            @method('delete')
            <button data-name="{{ $row->employee->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm" data-toggle="tooltip" title="Delete"><i class="fa fa-lg fa-trash"></i></button>
        </form>
    @endcan
</div>
<script>
    $('.delete-confirm').click(function (event) {
        let form = $(this).closest("form");
        let name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete ${name}?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
