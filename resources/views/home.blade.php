{{-- PLANTILLA QUE UTILIZA ESTA PÁGINA --}}
@extends('layout' , ['routeActive' => 'home'])

{{-- TITULO --}}
@section('title')
    Home
@endsection

{{-- ESTILOS EXCLUSIVOS PARA LA PAGINA DL HOME --}}
@section('styles')
<style>
    .wrapper{display: flex;justify-content: center;align-items: center;height: 100vh}
    .pulse{position: relative;animation:none;}
    .pulse:focus{animation-name: animate;animation-duration: 0.3s;animation-iteration-count: 1;animation-fill-mode: none;}                
    .pulse:active{animation:none;}
    @keyframes animate{
        0%{box-shadow: 0 0 0 0 rgba(74, 119, 255, 0.7) , 0 0 0 0 rgb(74, 119, 255, 0.7)}
        100%{box-shadow: 0 0 0 16px rgb(255, 109, 74, 0) , 0 0 0 0 rgb(74, 119, 255, 0.7)}            
    } 
    
    #toast-container > .toast {
        width: 100%;
    }      
</style> 
@endsection

{{-- CONTENIDO DE LA PAGINA DEL HOME --}}
@section('content')
    <section class="wrapper">
        <button id="mostrarTostadas" type="button" class="btn btn-primary btn-lg pulse">Order a Meal</button>
    </section>

    <div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
    </div>
@endsection

{{-- SCRIPT UNICO PARA LA PAGINA DEL HOME --}}
@section('scripts')
    <script>
        /* VARIABLE CONTADORA QUE SE SETTEA CON EL CONTENIDO DEL TOTAL DE ORDENES CREADAS Y SI NO EXISTE ENTONCES 1 */
        var count = @json($count) ?? 1        
        const HOST_API = "{{ config('app.api_url')}}"                

        /* CUANDO SE HAGA CLICK EN EL BOTON */
        document.getElementById("mostrarTostadas").addEventListener("click", function() {
            showToast("Order #" + count++)
            fetch(HOST_API+"/orders",{method:"POST",mode:"same-origin", headers: {"Content-Type": "application/json", "Accept": "application/json"}})
        });
    </script>
@endsection
