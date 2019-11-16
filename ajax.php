<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        function get_time() {
            $("#hora").load("../laboratorioweb/scripts/hora.php");
            setTimeout(get_time, 1000);
        };
        function get_users() {
            $("#registrosUsuarios").load("../laboratorioweb/scripts/getTotalNumberOfUsersAjax.php");
            setTimeout(get_users, 1000);
        };
    </script>
</head>

<body>
    <div id="hora">
        <h1>Hora del servidor</h1>
    </div>

    <div id="registrosUsuarios">
        <h2>Numero de registros de usuarios</h2>
    </div>

    <!-- When the webpage is loaded it is called only 1 TIME AFTER 2 SEC-->
    <script>
        setTimeout(get_time, 2000);
    </script>
    <script>
        setTimeout(get_users, 2000);
    </script>
</body>

</html>