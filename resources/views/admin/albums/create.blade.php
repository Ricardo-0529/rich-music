@extends('admin.layouts.app')

@section('title', 'Nuevo álbum')

@section('content')

<section class="admin-welcome">

    <p class="admin-eyebrow">GESTIÓN DEL CATÁLOGO</p>

    <h1>Nuevo álbum<span>.</span></h1>

    <p>Registra un nuevo lanzamiento en RICH MUSIC.</p>

</section>

<form
    action="{{ route('admin.albums.store') }}"
    method="POST"
    class="admin-form"
>
    @csrf

    @php($album = null)

    @include('admin.albums.form')

</form>

@endsection