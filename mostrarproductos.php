<?php
session_start();
 include('php/conexion.php');
 // paginador
 if(isset($_GET['id_subcategoria'])){ // nuevo
	 
 	$registros0=mysqli_query($conexion,"select id_producto from productos where id_subcategoria='$_GET[id_subcategoria]'") or die ("Error al conectar con la tabla".mysqli_error($conexion));
	
 }
 else{ // viejo
	 
	$registros0=mysqli_query($conexion,"select id_producto from productos where id_categoria='$_GET[id_categoria]'") or die ("Error al conectar con la tabla".mysqli_error($conexion));
	 
 }
 $numero_total_registros=mysqli_num_rows($registros0);
 $TAMANO_PAGINA = 8;
        $pagina = false;

        if (isset($_GET["pagina"]))
            $pagina = $_GET["pagina"];
        
	if (!$pagina) {
		$inicio = 0;
		$pagina = 1;
	}
	else {
		$inicio = ($pagina - 1) * $TAMANO_PAGINA;
	}
	$total_paginas = ceil($numero_total_registros / $TAMANO_PAGINA);
	/*
$registros1=mysqli_query($conexion,"select * from productos order by nombre asc LIMIT ".$inicio."," .$TAMANO_PAGINA) or die ("Error al conectar con la tabla".mysql_error($conexion));
	*/
 // paginador
 $registros1=mysqli_query($conexion,"select * from categorias order by categoria asc");
 
 if(isset($_GET['id_subcategoria'])){ // nuevo
 
 	if(isset($_GET['name']) && $_GET['name']=="mayormenor"){
 		$registros2=mysqli_query($conexion,"select id_producto, precio,cantidad from productos where id_subcategoria='$_GET[id_subcategoria]' AND cantidad!=-2 order by precio desc LIMIT ".$inicio."," .$TAMANO_PAGINA);
 	}
 
 	else{
	 
		$registros2=mysqli_query($conexion,"select id_producto, precio,cantidad from productos where id_subcategoria='$_GET[id_subcategoria]' AND cantidad!=-2 order by precio asc LIMIT ".$inicio."," .$TAMANO_PAGINA); 
	 
 	}
	
 }
 
  else{ // viejo
 
 	if(isset($_GET['name']) && $_GET['name']=="mayormenor"){
 		$registros2=mysqli_query($conexion,"select id_producto, precio,cantidad from productos where id_categoria='$_GET[id_categoria]' AND cantidad!=-2 order by precio desc LIMIT ".$inicio."," .$TAMANO_PAGINA);
 	}
 
 	else{
	 
		$registros2=mysqli_query($conexion,"select id_producto, precio,cantidad from productos where id_categoria='$_GET[id_categoria]' AND cantidad!=-2 order by precio asc LIMIT ".$inicio."," .$TAMANO_PAGINA); 
	 
 	}
	
 }
 
 $registros4=mysqli_query($conexion,"select categoria from categorias where id='$_GET[id_categoria]'");
 $fila4=mysqli_fetch_array($registros4);
 
 // para mostrar el nombre de la subcategor??a
 if(isset($_GET['id_subcategoria'])){
	 
 	$registros15=mysqli_query($conexion,"select nombre from subcategorias where id_subcategoria='$_GET[id_subcategoria]'");
 	$fila15=mysqli_fetch_array($registros15);
	
 }
 // para mostrar el nombre de la subcategor??a
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Productos</title>
<link rel="stylesheet" href="iconos/css/font-awesome.min.css">
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="css/normalizar.css">
<link rel="stylesheet" href="css/hover-min.css">
<link href='https://fonts.googleapis.com/css?family=Ceviche+One' rel='stylesheet' type='text/css'>
<!-- bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<!-- bootstrap -->
<script type="text/javascript">
function f_ordenar1(id,id_subcategoria){
	
	var name=document.form1.ordenar.value;
	location.href="mostrarproductos.php?name="+name+"&id_categoria="+id+"&id_subcategoria="+id_subcategoria;
	
}

function f_ordenar2(id){
	
	var name=document.form1.ordenar.value;
	location.href="mostrarproductos.php?name="+name+"&id_categoria="+id;
	
}
</script>


<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="CSS3 Menu_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
	<!-- End css3menu.com HEAD section -->
</head>
<body>
<header>
<div class="cabecera"></div>
<nav class="wow bounceInDown" data-wow-duration="1.5s">

<!-- Start css3menu.com BODY section -->
<input type="checkbox" id="css3menu-switcher" class="c3m-switch-input">
<ul id="css3menu1" class="topmenu">
	<li class="switch"><label onclick="" for="css3menu-switcher"></label></li>
	<li class="topmenu"><a href="index.php" style="width:172px;height:71px;line-height:71px;">INICIO</a></li>
	<li class="topmenu"><a class="pressed" href="#" style="width:197px;height:71px;line-height:71px;"><span>PRODUCTOS</span></a>
	<ul>
    <?php
	while ($fila1=mysqli_fetch_array($registros1)){	
		$registros10=mysqli_query($conexion,"select * from subcategorias where id_categoria='$fila1[id]' order by nombre asc");
	?>
		<li><a href="mostrarproductos.php?id_categoria=<?php echo $fila1['id']; ?>"><?php echo utf8_encode($fila1['categoria']);?></a>
        <ul>
        	<?php
			if(mysqli_num_rows($registros10)!=0){
				while ($fila10=mysqli_fetch_array($registros10)){	
			?>
			
			<li><a href="mostrarproductos.php?id_categoria=<?php echo $fila1['id']; ?>&id_subcategoria=<?php echo $fila10['id_subcategoria']; ?>"><?php echo utf8_encode($fila10['nombre']);?></a></li>
			
            <?php 
				}
			}
			?>
            </ul>
        </li>
    <?php
	}
	?>
	</ul>
    </li>
	<li class="topmenu"><a href="contacto.php" style="width:189px;height:71px;line-height:71px;">CONTACTO</a></li>
	<li class="topmenu"><a href="#" style="height:71px;line-height:71px;"><img src="CSS3 Menu_files/css3menu1/register.png" alt=""/>REGISTRO / ACCESO</a>
    	<ul>
			<li><a href="#" onclick="mostrar_ventana_modal()">INICIAR SESI??N</a></li>
			<li><a href="clientes/form_registro_clientes.php">REGISTRARSE</a></li>
		</ul>
    </li> 
</ul>
<!-- End css3menu.com BODY section -->

</nav>
</header>
<div class="main">

<div style="max-width:1000px">
<?php 

if(isset($_SESSION['nombre_cliente']) || isset($_COOKIE['nombre_cliente'])){

?>
<div style="margin-bottom:-4px; float:right">
<p style="font-family:'Ceviche One',cursive; font-size:24px"><a style=" text-decoration:none" href="clientes/zona_clientes"><span style="color:#F90">Bienvenido/a</span><span style="color:#FFF">
<?php
	if(isset($_SESSION['nombre_cliente'])) 
		echo $_SESSION['nombre_cliente'];

	if(!isset($_SESSION['nombre_cliente']) && isset($_COOKIE['nombre_cliente'])) 
		echo $_COOKIE['nombre_cliente'];
?>
</span></a></p>
</div>
<?php
}
?>

<p class="fuente"><span style="color:red">Inicio</span><span style="color:#FFF"> -></span><span style="color:#F90"><?php echo utf8_encode($fila4['categoria']); ?><?php if(isset($_GET['id_subcategoria'])) { ?></span><span style="color:#FFF"> -></span><span style="color: #F9F"><?php echo utf8_encode($fila15['nombre']); ?></span><?php } ?></p>
<p>
</div>
</br>

<?php
if(isset($_GET['id_subcategoria'])){
?>
<form name="form1">
<select onChange="f_ordenar1('<?php echo $_GET['id_categoria']; ?>',<?php echo $_GET['id_subcategoria']; ?>)" class="form-control" name="ordenar">
  <option>
  Ordenar por...
  </option>
  <option value="menormayor">Ordenar por precio de menor a mayor</option>
  <option value="mayormenor">Ordenar por precio de mayor a menor</option>
  
</select>
</form></p>
<?php
} else {
?>

<form name="form1">
<select onChange="f_ordenar2('<?php echo $_GET['id_categoria']; ?>')" class="form-control" name="ordenar">
  <option>
  Ordenar por...
  </option>
  <option value="menormayor">Ordenar por precio de menor a mayor</option>
  <option value="mayormenor">Ordenar por precio de mayor a menor</option>
  
</select>
</form></p>

<?php 
}
?>


<?php
while($fila2=mysqli_fetch_array($registros2)){
		$registros3=mysqli_query($conexion,"select nombre from imagenes where 	id_producto='$fila2[id_producto]' and prioridad=1");
		$fila3=mysqli_fetch_array($registros3);
?>
<a href="detalleproducto.php?id_categoria=<?php echo $_GET['id_categoria']; if(isset($_GET['id_subcategoria'])) {?>&id_subcategoria=<?php echo $_GET['id_subcategoria']; } ?>&id_producto=<?php echo $fila2['id_producto'];  ?>"><div class="productosmain hvr-float-shadow"><img src="administracion/productos/imagenes/<?php if(mysqli_num_rows($registros3)>0)echo $fila3['nombre']; else echo "no-disponible.jpg"; ?>" width="100%" alt="portatil1"/><div class="precio"><?php echo $fila2['precio']." Euros"; ?></div></div></a>
<?php
}
cerrarconexion();
?>
<div class="limpiar"></div>

<div class="centrar-pag">
<nav>
  <ul class="pagination"> 
<?php 
		
	if ($total_paginas > 1) {
		if ($pagina != 1)
		
		?>
			<li><a href="mostrarproductos.php?<?php if(isset($_GET['name'])){ ?>&name=<?php echo $_GET['name']; }?>&id_categoria=<?php echo $_GET['id_categoria']; if(isset($_GET['id_subcategoria'])) { ?>&id_subcategoria=<?php echo $_GET['id_subcategoria']; }?>&pagina=<?php echo ($pagina-1); ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
		
		<?php
			
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pagina == $i){
		?>		
				<li><a href="#"><div class="color-pag"><?php echo $pagina; ?></div></a></li>
        <?php
			}
			else{
		?>	
                <li><a href="mostrarproductos.php?<?php if(isset($_GET['name'])){ ?>&name=<?php echo $_GET['name']; }?>&id_categoria=<?php echo $_GET['id_categoria']; if(isset($_GET['id_subcategoria'])) { ?>&id_subcategoria=<?php echo $_GET['id_subcategoria']; }?>&pagina=<?php echo $i; ?>" aria-label="Previous"><span aria-hidden="true"><?php echo $i; ?></span></a></li>
        
        <?php
			}
		}
		if ($pagina != $total_paginas){
		?>
        	
            <li><a href="mostrarproductos.php?<?php if(isset($_GET['name'])){ ?>&name=<?php echo $_GET['name']; }?>&id_categoria=<?php echo $_GET['id_categoria']; if(isset($_GET['id_subcategoria'])) { ?>&id_subcategoria=<?php echo $_GET['id_subcategoria']; }?>&pagina=<?php echo ($pagina+1); ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            
    <?php
		}
	}
	?>
	</p>
		
	
		</ul>
	</nav>
	</div>
</div>
<footer style="margin-top:-10px" class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados tiendaonline.com</p></footer>


<!-- ventana modal -->
<div style="margin-top:100px" class="modal fade" id="mostrar_ventana_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" id="i" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Inicio de Sesi??n</h4>
      </div>
      <div class="modal-body">
        <form name="form_inicio_sesion">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Email:</label>
            <input type="text" name="email" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Password:</label>
            <input type="password" name="password" class="form-control" id="recipient-name">
          </div>
          
          
           <div class="checkbox">
    			<label>
      			<input type="checkbox" id="checkbox_recordar"> Recordar usuario.
    			</label>
 			</div>
          
          
        </form>
      </div>
      
     <!-- imagen de carga -->
      <center><div style="display:none;" id="carga"><img src="imagenes/cargando.gif"/></div></center>
      
      
      <div style="padding-left:10px; font-size:12px">
      	<a href="#" onclick="link_password()">He olvidado mi contrase??a</a>
      </div>
      
      <div style="padding:13px; display:none" id="link_password">
      	<form name="form_olvido_password">
      		<div class="form-group">
            	<label for="recipient-name" class="control-label">Email:</label>
            	<input type="text" name="email" class="form-control" id="recipient-name">
          	</div>
      	</form>
        <button type="button" onclick="recuperar_password()" class="btn btn-success">Recuperar Contrase??a</button>
      </div>
      
      <div class="modal-footer">
      
      <!-- aler contrase??a no correcta -->
      
      <div style="display:none" id="alertlogin" class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span   aria-hidden="true">&times;</span></button>
    <center>Email o password incorrecto</center>
    </div>

    
        <button type="button" onclick="validar_sesion()" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>


<!--carrito-->
<div id="b"  class="carrito">
	<div  style=" width:50px; height:120px; float:left; padding:4px; background-color:#333; border-radius:10px 0px 0px 10px; margin-left:-50px; cursor: pointer">
    		
    		<i style=" margin-top:33px; margin-left:200px; color:#f33; font-size:35px" class="fa fa-shopping-basket" aria-hidden="true"></i>  
      			
    </div>
    
     <!--numerito-->
    <?php 
	
	if(isset($_SESSION['cantidad_de_productos'])){
	
	?>
    
    <div id="cantidad_de_productos" style="position:absolute; width:30px; height:30px; background-color: #FFF; border-radius:100%; margin-top:81px; margin-left:-41px; border: solid 2px #FF3366; text-align:center; color: #F00; font-weight:bold; padding:2.5px; font-size:14px;"><?php echo $_SESSION['cantidad_de_productos']; ?></div>

    
    <?php
	
	}
	
	?>
    <!--numerito-->
    
    <div style="height:200px; padding:4px; overflow:auto" id="mostrar_compra">
        
    </div>
</div>
<!--carrito-->

<script type="text/javascript" src="clientes/inicio_de_sesion/inicio_de_sesion.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="compra/compra.js"></script>


</body>
</html>