
@extends('admin.layouts.app')

@section('title', 'Editar canción')

@section('content')

<section class="admin-welcome">
    <div>
        <span class="admin-eyebrow">CATÁLOGO MUSICAL</span>
        <h1>Editar canción</h1>
        <p>Modifica la información de {{ $track->title }}.</p>
    </div>
</section>

<div class="admin-form-container">

    @if ($errors->any())
        <div class="admin-error-message">
            Revisa los campos marcados antes de continuar.
        </div>
    @endif

    <form action="{{ route('admin.tracks.update', $track) }}" method="POST">
        @method('PUT')

        @include('admin.tracks.form')
    </form>

</div>

@endsection
