{{-- PLANTILLA QUE UTILIZA ESTA PÁGINA --}}
@extends('layout', ['routeActive' => 'horders'])

{{-- TITULO --}}
@section('title')
    Orders History
@endsection

{{-- ESTILOS EXCLUSIVOS PARA LA PAGINA DEL HISTORIAL DE ORDENES --}}
@section('styles')
    <style>
        body{ padding-top:5rem; }

        .orders{ width:40%;min-width:520px; margin:0 auto;display: flex;flex-direction: column;gap:12px; }
        .order-card{border-radius: 6px;width:100%;border:1px solid rgb(223, 223, 223);display:flex;padding:6px;}
        .order-text{padding-left: 30px;width:130px;}        
    </style>
@endsection

{{-- CONTENIDO DE LA PAGINA DEL HISTORIAL DE ORDENES --}}
@section('content')
    {{-- MOSTRAR EN LISTA VERTICAL LAS ORDENES QUE HAN SIDO DESPACHADAS --}}
    <section class="container">
        @if($orders->count() == 0)
            <h4 class="text-center mb-5">There are no orders at the moment, please create one in the Home</h4>
        @else
            <div class="orders">        
                @foreach ($orders as $order)
                    <div class="order-card">
                        <img src="{{ asset($order->food->food_path_img)}}" alt="foto" width="100px">
                        <div class="order-text">
                            <h3>{{$order->id}}</h3>
                            <p>{{$order->food->food_name}}</p>
                        </div>    
                        <div class="px-4 center">
                            <div>
                                <h6>Created on</h6>
                                <p>{{$order->created_at}}</p>
                            </div>
                        </div>            
                        <div class="center">
                            <div>
                                <h6>Dispached on</h6>
                                <p>{{$order->updated_at}}</p>                            
                            </div>
                        </div>                    
                    </div>                        
                @endforeach  
            </div>   
        @endif     
    </section>
@endsection
