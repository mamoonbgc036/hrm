@extends('welfare.welfare-layout')
@section('title', 'Welfare Create')
@section('welfare')
    <div class="container form-container">
        <div class="card form-card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Welfare Create</h5>
                <form action="{{ route('welfare.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="amount" class="form-label">Welfare Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create Welfare</button>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center p-2 small">ID</th>
                <th scope="col" class="text-center p-2 small">NAME</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse ($welfares as $key=>$item)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $item->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No Welfare fund exists</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
