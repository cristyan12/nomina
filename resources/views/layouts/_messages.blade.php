@if (session('info'))
    <div class="alert alert-success" role="alert">
         {{ session('info') }}
    </div>
@endif

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Por favor revise los siguientes errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
