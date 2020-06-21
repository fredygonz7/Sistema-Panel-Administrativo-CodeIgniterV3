<script>
    function cerrarSesion() {
        $(document).ready(function() {
            $.ajax({ //ajax jQuery
                type: "get",
                url: '<?= base_url() ?>index.php/Panel_Administrativo/cerrarSesion',
                data: "",
                success: function(respuesta) {
                    console.log("respuesta", respuesta);

                    if (typeof respuesta === 'string') {
                        let objetoRespuesta = JSON.parse(respuesta);
                        if (objetoRespuesta.status) {
                            console.log(objetoRespuesta.message);
                            setTimeout("location.href='<?= base_url() ?>'", 1000);
                        } else
                            alert(objetoRespuesta.message)
                    } else
                        console.log("Error inesperado");
                }
            });
        });
    }
</script>