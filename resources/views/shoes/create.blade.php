@extends('layouts.layout')
@section('header')
    <h1>Inserisci una scarpa</h1>
    @if ($errors->any()) 
      <div class="alert alert-danger"> 
        <ul> 
          @foreach ($errors->all() as $error) 
          <li>{{ $error }}</li> 
          @endforeach
        </ul>
      </div> 
    @endif
@endsection
@section('main')
    <form action="{{(!empty($shoe)) ? route('shoes.update', $shoe->id) : route('shoes.store')}}" method="post"> 
      @csrf 
      @if(!empty($shoe))
        @method('PATCH')
        @else
        @method('POST')
      @endif

      <div>
      <input type="text" name="brand" placeholder="Brand" value="{{(!empty($shoe)) ? $shoe->brand : ''}}">
      </div>

      <div>
        @if(!empty($shoe))
          <input type="text" name="size" placeholder="Size" value="{{$shoe->size}}">
        @else
          <input type="text" name="size" placeholder="Size">
        @endif
      </div>

      <div>
      <input type="text" name="color" placeholder="color" value="{{(!empty($shoe)) ?$shoe->color : ''}}">
      </div>

      <div>
        <input type="text" name="type" placeholder="type" value="{{(!empty($shoe)) ? $shoe->type : ''}}">
      </div>

      <div>
        <input type="text" name="material" placeholder="material" value="{{(!empty($shoe)) ? $shoe->material : ''}}">
      </div>

      <div>
        <textarea name="description" id="" cols="30" rows="10">
          {{(!empty($shoe)) ? $shoe->description : ''}}
        </textarea>
      </div>

      <div>
        <input type="text" name="price" placeholder="price" value="{{(!empty($shoe)) ? $shoe->price : ''}}">
      </div>

      <div>
        <input type="date" name="date_production" placeholder="Data di produzione" value="{{(!empty($shoe)) ? $shoe->date_production : ''}}">
      </div>
      
      @if(!empty($shoe))
    <input type="hidden" name="id" value="{{$shoe->id}}"> 
     @endif

      <input type="submit" value="Invia"> 
    </form>
@endsection