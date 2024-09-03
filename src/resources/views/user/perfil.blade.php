
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafic Hub</title>

    <link href="/img/logo.png" rel ="icon">
    <link href="/css/follow.css" rel ="stylesheet">
    <link href="/css/login.css" rel ="stylesheet">
    <link href="/css/dialog.css" rel ="stylesheet">
    <link href="/css/perfil.css" rel ="stylesheet">
    <link href="/css/project.css" rel ="stylesheet">
    <link href="/css/navbar.css" rel ="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">

</head>
    <body>
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
        <x-nav-bar/>
        <x-perfil.perfil :user="$user" :projects="$projects" :favoritos="$favoritos"/>
        <x-perfil.modal-criar-projeto />
        <x-perfil.modal-editar-perfil :user="$user"/>
        <x-perfil.modal-seguidores :seguidores="$seguidores" :userPerfil="$user"/>
        <x-perfil.modal-seguidos :seguindo="$seguindo" :userPerfil="$user"/>
        <x-perfil.modal-fone-usuario :user="$user"/>
        <x-perfil.modal-email-usuario :user="$user"/>
    </body>
</html>



