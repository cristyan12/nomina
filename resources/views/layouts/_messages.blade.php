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

@if (session('info'))
    <div class="alert alert-success">
        <ul>
            <li>{{ session('info') }}</li>
        </ul>
    </div>
@endif