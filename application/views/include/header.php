<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Panel Administrativo</title>
    <style type="text/css">
        .pointer {
            cursor: pointer;
        }
    </style>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- AJAX -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- script propios -->
    <!-- <script type="text/javascript" src="< ?=base_url() ?>js/librerias/claajax.js"></script> -->
    <!-- <script type="text/javascript" src="< ?=base_url() ?>js/librerias/clajson.js"></script> -->
    <!-- reCAPTCHA  -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- AJAX -->
    <script>
        /**
         * funcion general para peticiones ajax
         *
         * return void
         */
        function petiones_ajax(type, url, data, callback) {
            $.ajax({ //ajax jQuery
                type,
                url,
                data,
                success: function(respuesta) {
                    // console.log(respuesta);
                    if (typeof respuesta === 'string') {
                        let objetoRespuesta = JSON.parse(respuesta);
                        if (objetoRespuesta.status) {
                            console.log("ajax", objetoRespuesta.message);
                            callback(objetoRespuesta);
                        } else
                            alert(objetoRespuesta.message)
                    } else {
                        console.log("Error inesperado");
                        // respuestaInesperada = {
                        //     message: "Datos inesperados del servidor",
                        //     status: 0
                        // };
                        // callback(respuestaInesperada);

                    }
                }
            });
        }
    </script>
</head>

<body>