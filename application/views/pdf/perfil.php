<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">

    </style>
</head>

<body>
    <style>
        .grid-1 {
            /* width: auto; */
            width: 90%;
            padding: 10px;
        }

        .grid-2 {
            /* display: grid; */
            /* grid-template-columns: 30% 65%; */
            /* grid-gap: 10px; */
            padding: 10px;
            width: 50%;
        }

        .grid-3 {
            /* display: grid; */
            /* grid-template-columns: auto auto auto; */
            /* grid-gap: 10px; */
            padding: 10px;
            width: 30%;
        }

        /* div {
            // background-color: rgba(255, 255, 255, 0.8); 
            border: 1px solid black;
            // font-size: 20px; 
        } */

        .left {
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .top {
            align-items: top;
        }

        .negrita {
            font-weight: bold;
            /* font-style: italic; */
        }

        .p-1 {
            padding: 10px;
        }

        td {
            text-align: left;
            padding: 0px;
            margin-top: 5px;
        }
    </style>
    </head>

    <body>
        <!-- <div class="p-1">
            <div class="grid-3">
                <img src="< ?= $avatar; ?>" alt=" Sin avatar" id="avatar" class="grid-1">
            </div>
            <div class="center grid-2">
                <div>
                    <h3 id="nombresapellidos"> < ?= $nombresapellidos; ?></h3>
                    <h4 id="email">< ?= $email; ?></h4>
                    <h4 id="perfil">Tu perfil es < ?= $perfil; ?></h4>
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
    -->
        <table style="width:650px">
            <!-- <tr>
                <td colspan="1" rowspan="9" style="vertical-align: top;">
                    <div class="center">
                        <img src="< ?= $avatar; ?>" alt=" Sin avatar" id="avatar" style="width:140px; margin-top: 0px;">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
            <tr>
                <td colspan="3" class="left">
                    <h3 id="nombresapellidos"> < ?= $nombresapellidos; ?></h3>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="left">
                    <h4 id="email">< ?= $email; ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="left">
                    <h4 id="perfil">Tu perfil es < ?= $perfil; ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="negrita">Intereses</div>
                </td>
            </tr>
            <tr>
                <td colspan="3">< ?= $intereses; ?></td>
            </tr> -->


            <tr>
                <td colspan="1" rowspan="9" style="vertical-align: top;">
                    <div class="center">
                        <img src="<?= $avatar; ?>" alt=" Sin avatar" id="avatar" style="width:140px; margin-top: 0px;">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1" class="left">
                    <h3 id="nombresapellidos"> <?= $nombresapellidos; ?></h3>
                </td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1" class="left">
                    <h4 id="email"><?= $email; ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="left">
                    <h4 id="perfil">Tu perfil es <?= $perfil; ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">
                    <div class="negrita">Intereses</div>
                </td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1"><?= $intereses; ?></td>
            </tr>


            <!-- <tr style="margin-top: 40px;">
                <td rowspan="1">
                    <input type="checkbox" id="gastronomia">
                    <label>
                        Gastronomia
                    </label></td>
                <td>
                    <input type="checkbox" id="gastronomia">
                    <label>
                        Deportes
                    </label></td>
                <td>
                    <input type="checkbox" id="gastronomia">
                    <label>
                        Desarrollo web
                    </label>
                </td>

            </tr>
            <tr>
                <td>
                    <input type="checkbox" id="gastronomia">
                    <label>
                        Desarrollo movil
                    </label>
                </td>
                <td>
                    <input type="checkbox" id="gastronomia">
                    <label>
                        Politica
                    </label>
                </td>
                <td>
                    <input type="checkbox" id="gastronomia">
                    <label>
                        Cine
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" id="gastronomia">
                    <label>
                        Esoterismo
                    </label>
                </td>
                <td>
                    <input type="checkbox" id="gastronomia">
                    <label>
                        Hogar y moda
                    </label>
                </td>
                <td>
                    <input type="checkbox" id="gastronomia">
                    <label>
                        Psicologia
                    </label>
                </td>
            </tr> -->


            <!-- </td>
            </tr> -->
        </table>
    </body>

</html>