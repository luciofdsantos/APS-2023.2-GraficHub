<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>
    <link href="/css/index.css" rel="stylesheet">
    <link href="/img/logo.png" rel ="icon">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



</head>
<body onload="getPage()">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/js/show.js"></script>

        <script>

            document.addEventListener('DOMContentLoaded', function() {
                if(localStorage.getItem('lastModal') == 'editProjectModal'){
                    @if($errors->any())
                        $('#editProjectModal').modal('show');
                    @endif
                }
                else if (localStorage.getItem('lastModal') === 'offcanvasComments') {
                    var offcanvasElement = document.getElementById('offcanvasComments'); // Pega o elemento offcanvas
                    var offcanvasInstance = bootstrap.Offcanvas.getOrCreateInstance(offcanvasElement); // Cria a instância do offcanvas
                    offcanvasInstance.show(); // Mostra o offcanvas
                }
            });
        </script>
        <x-nav-bar/>
        <x-projeto.project :project="$project" :images="$images"/>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
        <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
        <script src="{{ asset('js/functions.js') }}"></script>
        <script src="{{asset('js/project.js')}}"></script>
        <x-projeto.modal-show-comments :project="$project"/>
        <x-projeto.modal-editar-projeto :project="$project"/>


</body>
</html>

