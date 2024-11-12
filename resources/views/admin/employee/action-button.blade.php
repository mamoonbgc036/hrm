<div class="btn-group">
    @can('Employee show')
        <a class="btn btn-sm btn-primary" href="{{ route('employee.show', $row->id) }}" data-toggle="tooltip" title="Show">
            <i class="fa fa-lg fa-eye"></i></a>
    @endcan
    @can('Employee edit')
        <a class="btn btn-sm btn-warning" href="{{ route('employee.edit', $row) }}" data-toggle="tooltip" title="Edit">
            <i class="fa fa-lg fa-edit"></i></a>
    @endcan
    {{-- @can('Edit history')
        @include('admin.partial.edit_history',['model' => Spatie\Activitylog\Models\Activity::query()
            ->with('causer')
            ->where('log_name','Employee')
            ->whereNotNull('causer_id')
            ->where('subject_id',$row->id)
            ->where('description','updated')
            ->get()])
    @endcan --}}
    @can('Employee assign')
        <a class="btn btn-sm btn-info" href="{{ route('employee.assign', $row->id) }}" data-toggle="tooltip" title="Assign">
            <i class="fa fa-arrow-up"></i></a>
    @endcan
    @can('Employee delete')
        <form method="POST" action="{{ route('employee.destroy', $row->id) }}" class="">
            @csrf
            @method('DELETE')
            <input type="hidden" name="_method" value="delete">
            <button data-name="{{ $row->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
                data-toggle="tooltip" title="Delete"><i class="fa fa-lg fa-trash"></i></button>
        </form>
    @endcan
</div>
<script>
    $('.delete-confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();

        Swal.fire({
            title: `Are you sure you want to delete ${name}?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
