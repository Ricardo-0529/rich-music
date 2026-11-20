
@extends('admin.layouts.app')

@section('title', 'Nueva canción')

@section('content')

<section class="admin-welcome">
    <div>
        <span class="admin-eyebrow">CATÁLOGO MUSICAL</span>
        <h1>Nueva canción</h1>
        <p>Registra una nueva pista en la discografía.</p>
    </div>
</section>

<div class="admin-form-container">

    @if ($errors->any())
        <div class="admin-error-message">
            Revisa los campos marcados antes de continuar.
        </div>
    @endif

    <form action="{{ route('admin.tracks.store') }}" method="POST">
        @include('admin.tracks.form')
    </form>

</div>

@endsection
