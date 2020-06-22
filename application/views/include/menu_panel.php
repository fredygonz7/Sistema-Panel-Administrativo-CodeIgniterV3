<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?= base_url() ?>">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" id="administrarUsuarios" onclick="administrarUsuarios()" style="display:none">Administar Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#editarPerfilModal" onclick="mostrarDatosFormularioEditar()">Editar Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="cerrarSesion()">Cerrar Sesion</a>
            </li>
        </ul>
    </div>
</nav>

<!-- <form method="post" action="< ?= base_url() ?>index.php/Panel_Administrativo/cerrarSesion" id="formulario-registrar"> -->
<!-- <button type="button" class="btn btn-primary" onclick="cerrarSesion()">Cerrar Sesion</button> -->
<!-- Button editar perfil modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarPerfilModal" onclick="mostrarDatosFormularioEditar()">
    Editar Perfil
</button>
<button type="button" class="btn btn-primary" id="administrarUsuarios" onclick="administrarUsuarios()" style="display:none">Administrar Usuarios</button> -->
<!-- </form> -->
<div class="container">