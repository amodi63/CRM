
@props(['type'])
@switch(session()->has($type))
    @case('success')
    <div class="alert alert-{{ $type }}  alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
        @break
    @case('warning')
    <div class="alert alert-{{ $type }}  alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button"  class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
        @break
    
    @case('error')
        <div class="alert alert-danger   alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @break
    
@endswitch
