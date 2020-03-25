@extends('layouts.layout')
@section('header')
    @if (session('id'))
        <div class="alert alert-success">
            Hai cancellato la scarpa id: {{ session('id') }}
        </div>
    @endif


    <h1>Tutte le scarpe</h1>
    @if(!empty($id))
      <div>Hai cancellato il record {{$id}}</div>
    @endif
@endsection
@section('main')
<div class="shoes">
  @foreach ($shoes as $shoe)
    <div class="shoe">
      <ul>
        <li>Id: {{$shoe->id}}</li>
        <li>Brand: {{$shoe->brand}}</li>
        <li>Size: {{$shoe->size}}</li>
        <li>Color: {{$shoe->color}}</li>
        <li>Type: {{$shoe->type}}</li>
        <li>Material: {{$shoe->material}}</li>
        <li>Description: {{$shoe->description}}</li>
        <li>Price: {{$shoe->price}}</li>
        <li>Data di produzione: {{$shoe->date_production}}</li>
        <li>Creato il: {{$shoe->created_at}}</li>
        <li>Aggiornato il: {{$shoe->updated_at}}</li>
        <li>
          <form action="{{route('shoes.destroy', $shoe->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
          </form>
        </li>
      </ul>
    </div>   
  @endforeach
</div>
@endsection