<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">

    </style>
</head>

<body>
    <style>
        .grid-1 {
            width: auto;
        }

        .grid-1-2 {
            /* display: grid; */
            grid-template-columns: 30% 65%;
            grid-gap: 10px;
            padding: 10px;
        }

        .grid-3 {
            /* display: grid; */
            grid-template-columns: auto auto auto;
            grid-gap: 10px;
            padding: 10px;
        }

        div {
            /* background-color: rgba(255, 255, 255, 0.8); */
            /* border: 1px solid black; */
            font-size: 20px;
        }

        .left {
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .negrita {
            font-weight: bold;
            /* font-style: italic; */
        }
    </style>
    </head>

    <body>
        <div class="grid-1-2">
            <div class="grid-1">
                <img src="<?= $avatar; ?>" alt=" Sin avatar" id="avatar">
            </div>
            <div class="center grid-1">
                <div>
                    <h3 id="nombresapellidos"> <?= $nombresapellidos; ?></h3>
                    <h4 id="email"><?= $email; ?></h4>
                    <h4 id="perfil">Tu perfil es <?= $perfil; ?></h4>
                </div>

                <div class="left grid-3">
                    <div class="negrita">
                        Intereses
                    </div>
                </div>
                <div class="left grid-1">
                    <div id="div-intereses" class="grid-3 left">
                        <div>
                            <input type="checkbox" id="gastronomia">
                            <label>
                                Gastronomia
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="gastronomia">
                            <label>
                                Deportes
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="gastronomia">
                            <label>
                                Desarrollo web
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="gastronomia">
                            <label>
                                Desarrollo movil
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="gastronomia">
                            <label>
                                Politica
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="gastronomia">
                            <label>
                                Cine
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="gastronomia">
                            <label>
                                Esoterismo
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="gastronomia">
                            <label>
                                Hogar y moda
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" id="gastronomia">
                            <label>
                                Psicologia
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // document.getElementById("email").innerText = datos_usuario.data.email;
            // let datos_usuario = <?= $datos_usuario; ?>;
            // if (typeof datos_usuario == 'object' && datos_usuario.status) {
            //     // document.getElementById("avatar").src = datos_usuario.data.avatar;
            //     document.getElementById("nombreapellido").innerText = datos_usuario.data.nombres + " " + datos_usuario.data.nombres;
            //     document.getElementById("email").innerText = datos_usuario.data.email;
            //     console.log(datos_usuario);
            // }


            // let respuesInteresesUsuario = <?= $intereses_usuario; ?>;
            // if (typeof respuesInteresesUsuario == 'object' && respuesInteresesUsuario.status) {
            //     console.log(respuesInteresesUsuario.data);
            //     // <div>
            //     //     <input type="checkbox" id="gastronomia">
            //     //     <label>
            //     //         Gastronomia
            //     //     </label>
            //     // </div>

            //     let arrayNombreInteres = ["gastronomia", "deportes", "desarrolo_web", "desarrollo_movil", "politica", "cine",
            //         "esoterismo", "hogar_y_moda", "psicologia"
            //     ];

            //     let contenedor = document.getElementById("div-intereses");
            //     while (contenedor.hasChildNodes()) {
            //         contenedor.removeChild(contenedor.firstChild);
            //     }

            //     for (let index = 0; index < arrayNombreInteres.length; index++) {

            //         // <div>
            //         let div = document.createElement("div");

            //         // <input type="checkbox" id="gastronomia">
            //         let input = document.createElement("input");
            //         input.type = "checkbox";
            //         if (respuesInteresesUsuario.data[arrayNombreInteres[index]] == "true")
            //             input.checked = true;

            //         div.appendChild(input);
            //         // fin input

            //         //      <label>
            //         let label = document.createElement("label");
            //         // texto primera en mayuscula
            //         let texto = arrayNombreInteres[index][0].toUpperCase() + arrayNombreInteres[index].slice(1);
            //         label.appendChild(document.createTextNode(texto));
            //         div.appendChild(label);
            //         //     </label>

            //         // </div>
            //         contenedor.appendChild(div);
            //     }
            // }
        </script>
    </body>

</html>