
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">

</head>
    <body style="background-color: #fbfbfb">
    <script >
        if( localStorage.getItem('followdirection') == 'followed'){
            document.addEventListener('DOMContentLoaded', function() {

                openModal('box-show-followeds');
            });
            console.log( localStorage.getItem('followdirection'));
        }
        else if(localStorage.getItem('followdirection') == 'follower'){
            document.addEventListener('DOMContentLoaded', function() {

                openModal('box-show-followers');
            });
            console.log( localStorage.getItem('followdirection'));
        }
    </script>
        <section class="navbar-section">
            <x-nav-bar/>
        </section>
        <x-perfil.perfil :user="$user" :projects="$projects" :favoritos="$favoritos"/>
        <x-perfil.modal-criar-projeto />
        <x-perfil.modal-editar-perfil :user="$user"/>
        <x-perfil.modal-seguidores :seguidores="$seguidores" :userPerfil="$user"/>
        <x-perfil.modal-seguidos :seguindo="$seguindo" :userPerfil="$user"/>
        <x-perfil.modal-fone-usuario :user="$user"/>
        <x-perfil.modal-email-usuario :user="$user"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>



