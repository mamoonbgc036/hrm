<div class="btn-group">
    @can('Achievement show')
        <a class="btn btn-sm btn-success" href="{{route('show-achievement-employee',[$row->achievement->id,$row->employee->id])}}" data-toggle="tooltip" title="Show"><i class="fa fa-lg fa-eye"></i></a>
    @endcan
    @can('Achievement edit assigned')
        <a class="btn btn-sm btn-group-sm btn-primary" href="{{route('edit-achievement-employee',[$row->achievement->id,$row->employee->id])}}" data-toggle="tooltip" title="Edit Employee Achievement"><i class="fa fa-lg fa-edit"></i></a>
    @endcan
    @can('Achievement delete assigned')
        <form method="POST" action="{{route('achievement-employee-delete',[$row->achievement->id,$row->employee->id])}}" class="">
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
