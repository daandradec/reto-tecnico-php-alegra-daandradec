<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- CONFIGURACIONES META --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.ico') }}" />

    {{-- TITULO DEL SITIO --}}
    <title>@yield('title')</title>

    {{-- FUENTE POPPINS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- LIBRERIA DE UI - BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    {{-- ESTILOS POR DEFECTO --}}
    <style>
        html, body{
            padding: 0;
            margin: 0;
            height: 100vh;
            min-height: 100%;
            width: 100%;
            font-size: 14px;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }
        span, p, a{
            margin:0;
            padding:0;
            font-size:1rem;
        }
        
        a{
            text-decoration: none;
            outline: none;
        }    
        
        ul{
            list-style-type: none;
            text-decoration: none;  
            list-style: none;
            padding: 0;
            margin: 0;
        }  
        
        *, ::after, ::before {
            box-sizing: border-box;
        }	

        img, svg {
            vertical-align: middle;
        }   
        
        nav{position: fixed; top:0; left:0;width: 100%;} 
        nav ul{display: flex;justify-content: center;align-items: center;}
        nav ul{gap: 20px;padding:20px 0;}

        .center{
            display: flex;
            display : -webkit-flex;
            vertical-align: middle;
            justify-content: center;
            align-items: center;
            text-align: center;
        }        
    </style>
    {{-- SECCIÓN PARA ESTILOS --}}
    @yield('styles')

    {{-- SECCIÓN DE CONFIGURACIONES DE VITEJS --}}
    @isset($react)
        @viteReactRefresh
        @vite('resources/js/app.js')
    @endisset
</head>
<body>
    {{-- BARRA DE NAVEGACIÓN --}}
    <nav class="bg-white">
        <ul>
            <li><a href="{{ url('/') }}" {{$routeActive != "home" ? "style=color:gray;" : ""}}>Home</a></li>
            <li><a href="{{ url('/dashboard') }}" {{$routeActive != "dashboard" ? "style=color:gray;" : ""}}>Dashboard</a></li>
            <li><a href="{{ url('/history/orders') }}" {{$routeActive != "horders" ? "style=color:gray;" : ""}}>Order History</a></li>
            <li><a href="{{ url('/history/stocks') }}" {{$routeActive != "hstocks" ? "style=color:gray;" : ""}}>Stock History</a></li>
        </ul>
    </nav>

    {{-- SECCIÓN DE CONTENIDO --}}
    @yield('content')

    {{-- ETIQUETAS HELPERS PARA REACT --}}
    @isset($react)
        <div id="props" data-ingredients="{{ $ingredients }}" data-orders="{{ $orders }}" data-foods="{{ $foods }}"></div>
        <div id="root"></div>    
    @endisset
    
    {{-- SECCIÓN DE SCRIPTS --}}
    @yield('scripts')
    <script>  
        /* FUNCION PARA MOSTRAR UNA TOSTADA DE NOTIFICACIÓN EN LA ESQUINA INFERIOR DERECHA */      
        function showToast(textInput, bg='bg-primary', time=4000) {
            // Generar un ID único para cada tostada
            var toastId = Date.now();

            // Crear el elemento de la tostada
            var toast = document.createElement("div");
            toast.id = "toast-" + toastId;
            toast.className = "toast text-white border-0 my-2 "+bg;
            toast.setAttribute("role", "alert");
            toast.setAttribute("aria-live", "assertive");
            toast.setAttribute("aria-atomic", "true");

            // Crear el contenido de la tostada
            var toastBody = document.createElement("div");
            toastBody.className = "d-flex align-middle align-items-center";
            toast.appendChild(toastBody);

            // Agregar el icono de cierre
            var closeIcon = document.createElement("i");
            closeIcon.className = "fs-4 px-2 fa-solid fa-xmark";
            closeIcon.addEventListener("click", function() {
                document.getElementById("toast-" + toastId).remove();
            });
            toastBody.appendChild(closeIcon);

            // Agregar el texto de la tostada
            var toastText = document.createElement("div");
            toastText.className = "toast-body";
            toastText.innerHTML = textInput;
            toastBody.appendChild(toastText);

            // Agregar la tostada al contenedor de tostadas
            var toastContainer = document.getElementById("toast-container");
            toastContainer.appendChild(toast);

            // Mostrar la tostada
            var bootstrapToast = new bootstrap.Toast(toast);
            bootstrapToast.show();

            // Ocultar la tostada después de 4 segundos
            setTimeout(function() {
                bootstrapToast.hide();
                document.getElementById("toast-" + toastId).remove();
            }, time);            
        }
    </script>    
</body>
</html>