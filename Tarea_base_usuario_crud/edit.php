<?php
// include database connection file
include_once("config.php");

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $correo=$_POST['correo'];
    $contraseña=$_POST['contraseña'];

    // update user data
    $result = mysqli_query($mysqli, "UPDATE usuario SET correo='$correo',contraseña='$contraseña' WHERE id=$id");

    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM usuario WHERE id=$id");

while($user_data = mysqli_fetch_array($result))
{
	$correo = $user_data['correo'];
        $contraseña = $user_data['contraseña'];
}
?>
<html>
<head>
	<title>Editar Usuario</title>
</head>

<body>
	<a href="index.php">Inicio</a>
	<br/><br/>

	<form name="update_user" method="post" action="edit.php">
		<table border="0">
			<tr>
				<td>CORREO</td>
				<td><input type="text" name="correo" value=<?php echo $correo;?>></td>
			</tr>
			<tr>
				<td>CONTRASEÑA</td>
				<td><input type="text" name="contraseña" value=<?php echo $contraseña;?>></td>
			</tr>                         
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Cargar"></td>
			</tr>
		</table>
	</form>
</body>
</html>



