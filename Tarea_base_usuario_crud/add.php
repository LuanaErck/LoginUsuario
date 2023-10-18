<?php
// Create database connection using config file
include_once("config.php");
?>

<?php
echo "<a href='login.php'>Iniciar Sesion</a><br>";
?>

<hr />

<html>
<head>
	<title>Añadir Usuario</title>
</head>
<body>
        <a href="index.php">Ir a la tabla con datos</a>
        <hr />
        
        <p>Crear usuario nuevo: <p/>

        <form id = "datos" action="add.php" method="post" name="form1" onsubmit="return validar_entradas_nuevas()">
                <table width="25%" border="0">
			<tr>
				<td>Correo</td>
				<td><input type="text" id = "correo" name="correo"></td>
			</tr>
			<tr>
				<td>Contraseña</td>
				<td><input type="text" id = "contraseña" name="contraseña"></td>
			</tr>
			<tr>
				<td>Repetir contraseña</td>
				<td><input type="text" id = "contraseña2" name="contraseña2"></td>
			</tr>                       
			<tr>
				<td></td>
				<td><input type="submit" name="Submit" value="Enviar"></td>
			</tr>
		</table>
	</form>
<hr />

<script>
    function validar_entradas_nuevas() 
    {
        var correo = document.getElementById("correo").value;
        var contraseña = document.getElementById("contraseña").value;
        var contraseña2 = document.getElementById("contraseña2").value;
        
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(correo))
        {
            alert("formato de correo incorrecto");
            return false;
        }
        
        if (correo == "")
        {
            alert("Incorrecto, ingrese correo");
            return false;
        }
        
        if (contraseña == "")
        {
            alert("incorrecto, ingrese contraseña");
            return false;
        } 
        
        if (contraseña2 == "")
        {
            alert("incorrecto, ingrese contraseña");
            return false;
        }
        
        if (contraseña.length<8) 
        {
            alert("incorrecto, la contraseña debe tener al menos 8 caracteres");
            return false;
        }

        if (contraseña2.length<8) 
        {
            alert("incorrecto, la contraseña debe tener al menos 8 caracteres");
            return false;
        }
        if (contraseña2 != contraseña)
        {
            alert ("Las contraseñas no cionciden");
            return false
        }
    return true;
    //this.submit();
    }       
</script>

<?php
$servername = "localhost";
$username = "phpmyadmin";
$password = "alumno";
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

extract($_REQUEST);

// Check If form submitted, insert form data into users table.
if(isset($_POST['Submit'])) 
{
	$correo = $_POST['correo'];
        $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT); // Hash de la contraseña

	// include database connection file
	include_once("config.php");

	// Insert user data into table
	$result = mysqli_query($mysqli, "INSERT INTO usuario(correo, contraseña) VALUES('$correo','$contraseña')");

	if (!$result) 
        {
            die("Error: " . mysqli_error($mysqli));
        } 
        else 
        {
            echo "Usuario agregado exitosamente <a href='index.php'>Ver Usuarios</a><br>";
        }
}
?>

</body>
</html>

