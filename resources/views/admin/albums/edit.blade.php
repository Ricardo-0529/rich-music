@extends('admin.layouts.app')

@section('title', 'Editar álbum')

@section('content')

<section class="admin-welcome">

    <p class="admin-eyebrow">GESTIÓN DEL CATÁLOGO</p>

    <h1>Editar álbum<span>.</span></h1>

    <p>Modifica la información de {{ $album->title }}.</p>

</section>

<form
    action="{{ route('admin.albums.update', $album) }}"
    method="POST"
    class="admin-form"
>
    @csrf
    @method('PUT')

    @include('admin.albums.form')

</form>

@endsection