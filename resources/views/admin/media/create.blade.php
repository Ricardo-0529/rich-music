
@extends('admin.layouts.app')

@section('title', 'Nuevo enlace multimedia')

@section('content')

<section class="admin-welcome">
    <div>
        <span class="admin-eyebrow">INTEGRACIONES</span>
        <h1>Nuevo enlace</h1>
        <p>Vincula contenido con plataformas externas.</p>
    </div>
</section>

<div class="admin-form-container">

    @if ($errors->any())
        <div class="admin-error-message">
            Revisa los campos marcados antes de continuar.
        </div>
    @endif

    <form action="{{ route('admin.media.store') }}" method="POST">
        @include('admin.media.form')
    </form>

</div>

@endsection
