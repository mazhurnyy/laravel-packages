{{-- Ответ на отправку формы --}}

@if (session('status'))
    <div class="alert alert-{{ session('alert') ? session('alert') : 'success' }}">
        {{ session('status') }} 
        @if (session('status_link'))
            <a href="{{ session('status_link')['route'] }}" class="alert-link">{{ session('status_link')['title'] }}</a>.
        @endif
    </div>
@endif