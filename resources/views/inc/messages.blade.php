@if (count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li class="list-group-item btn-danger">{{ $error }}</li>
        @endforeach
    </ul>
@endif