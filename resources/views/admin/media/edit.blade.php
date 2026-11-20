
@extends('admin.layouts.app')

@section('title', 'Editar enlace multimedia')

@section('content')

<section class="admin-welcome">
    <div>
        <span class="admin-eyebrow">INTEGRACIONES</span>
        <h1>Editar enlace</h1>
        <p>Modifica la configuración de {{ $media->label }}.</p>
    </div>
</section>

<div class="admin-form-container">

    @if ($errors->any())
        <div class="admin-error-message">
            Revisa los campos marcados antes de continuar.
        </div>
    @endif

    <form action="{{ route('admin.media.update', $media) }}" method="POST">
        @method('PUT')

        @include('admin.media.form')
    </form>

</div>

@endsection
