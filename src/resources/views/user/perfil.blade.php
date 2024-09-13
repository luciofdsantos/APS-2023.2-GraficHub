
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>

    <link href="/img/logo.png" rel ="icon">
    <link href="/css/index.css" rel ="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->


    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">

</head>
    <body class="perfil-body" >

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script >
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('lastModal') == 'seguidoresModal') {
                $('#seguidoresModal').modal('show');

            } else if (localStorage.getItem('lastModal') == 'seguindoModal') {
                $('#seguindoModal').modal('show');
            } else if (localStorage.getItem('lastModal') == 'EditProfileModal') {
                @if($errors->any())  onload="resetModal()"
                $('#EditProfileModal').modal('show');
                @endif
            } else if (localStorage.getItem('lastModal') == 'createProjectModal') {
                @if($errors->any())  onload="resetModal()"
                $('#createProjectModal').modal('show');
                @endif
            }
        });


    </script>

        <section class="navbar-section">
            <x-nav-bar/>
        </section>
        <x-perfil.perfil :user="$user" :projects="$projects" :favoritos="$favoritos"/>
    <script src="{{ asset('js/functions.js') }}"></script>
        <x-perfil.modal-criar-projeto />
        <x-perfil.modal-editar-perfil :user="$user"/>
        <x-perfil.modal-seguidores :seguidores="$seguidores" :userPerfil="$user"/>
        <x-perfil.modal-seguidos :seguindo="$seguindo" :userPerfil="$user"/>
        <x-perfil.modal-fone-usuario :user="$user"/>
        <x-perfil.modal-email-usuario :user="$user"/>

    </body>
</html>


