
<?php
// Create database connection using config file
include_once("config.php");
?>

<?php
echo "<a href='add.php'>Crear Usuario</a><br>";
?>

<?php
// Start the session
session_start();
?>

<hr />

<html>
<head>
	<title>Login</title>       
</head>
<body>
    <p>Inciar Sesion: <p/>
        <form id = "datos" action="login.php" method="post" name="form1" onsubmit="return validar_entradas1() && validar_entradas2()">
		<table width="25%" border="0">
			<tr>
				<td>Correo</td>
				<td><input type="text" id = "correo" name="correo"></td>
			</tr>
			<tr>
				<td>Contraseña</td>
				<td><input type="password" id = "contraseña" name="contraseña"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="Submit" value="Ingresar"></td>
			</tr>
		</table>
	</form>
        <hr />

<script>
    function validar_entradas1() 
    {
        var correo = document.getElementById("correo").value;
        var contraseña = document.getElementById("contraseña").value;        
        
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
        
        if (contraseña.length<8) 
        {
            alert("incorrecto, la contraseña debe tener al menos 8 caracteres");
            return false;
        }

    return true;
    //this.submit();
    }       
</script>

<?php
function validar_entradas2()
{
    global $servername, $username, $password, $dbname;

    if (isset($_POST['Submit'])) 
    {
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        $conn = mysqli_connect($servername, $username, $password, $dbname);;

        $sql = "SELECT correo, contraseña FROM usuario WHERE correo='$correo'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) 
        {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($contraseña, $row['contraseña'])) 
            {
                // Inicio de sesión exitoso, establecer una sesión
                $_SESSION['correo'] = $correo;
                $_SESSION['contraseña'] = $contraseña;

                // Redirigir al usuario al perfil
                header("Location: index.php");
                exit(); // Salir del script para evitar que se siga ejecutando
            }
        }
        else 
        {
        // Si llegamos aquí, significa que el inicio de sesión falló
        $mensajeError = "Login fallido. Verifica tu correo y contraseña.";        
        }
    }   
}
?> 



</body>
</html>

