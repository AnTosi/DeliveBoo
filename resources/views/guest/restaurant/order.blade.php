@extends('layouts.app')

@section('content')

    <div class="div">
    @foreach ($listaOrdine as $id => $qty)

        @foreach ($piatti as $item)
            @if ($id == $item->id)
                <p>
                    piatto: {{$item->name}}, qty: {{$qty}}
                </p>
            @endif
        @endforeach
        
    @endforeach
    </div>
@endsection