<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta tu DNI</title>
  <link rel="stylesheet" type="text/css" href="./assets/styles/styles.css">
  <script src="./assets/js/jquery.min.js"></script>
  <link rel="icon" href="./assets/favicon.ico" type="image/x-icon">
</head>
<body>
  <canvas class="orb-canvas"></canvas>
  <!-- Overlay -->
  <div class="overlay">
  <!-- Overlay inner wrapper -->
    <div class="overlay__inner">
      <!-- Title -->
      <h1 class="overlay__title">
        <span class="text-gradient">Consulta tu número de</span>
      </h1>
      <div class="form__group field">
        <input type="text" class="form__field" placeholder="D.N.I." name="dni" id="dni" required autocomplete="off"  />
        <label for="dni" class="form__label">D.N.I.</label>
      </div>
      <br/>
      <div>Nombres: <label id="nombre"></label></div>
      <div>Apellido Paterno: <label id="apellidop"></label></div>
      <div>Apellido Materno: <label id="apellidom"></label></div>
      <div>Fecha de Nacimiento: <label id="fecha_nacimiento"></label></div>
      <div>Telefono: <label id="telefono"></label></div>
      <div>Direccion: <label id="direccion"></label></div>
      <div>Distrito: <label id="distrito"></label></div>
      <div>Estado Civil: <label id="estado_civil"></label></div>
      <div>Sexo: <label id="sexo"></label></div>
      <br/>
      <!-- Buttons -->
      <div class="overlay__btns">
        <button class="overlay__btn overlay__btn--transparent" id="prueba" >
            Consultar
        </button>
        <button class="overlay__btn overlay__btn--colors">
          <span>Cambiar tema</span>
          <span class="overlay__btn-emoji">🎨</span>
        </button>
      </div>
    </div>
  </div>

<script>
$(document).ready(function(){
  $(".para_ruc").hide();
});
$("#prueba").click(function(){
  var dni=$("#dni").val();
  $.ajax({           
    type:"POST",
    url: "get_dni.php",
    data: 'dni='+dni,
    dataType: 'json',
    success: function(response) {
        if(response==1) {
          $("#nombre").html("No encontrado");
          $("#apellidop").html("No encontrado");
          $("#apellidom").html("No encontrado");
          $("#fecha_nacimiento").html("No encontrado");
          $("#telefono").html("No encontrado");
          $("#direccion").html("No encontrado");
          $("#distrito").html("No encontrado");
          $("#estado_civil").html("No encontrado");
          $("#sexo").html("No encontrado");
        } else {
          console.log(response);
          $("#nombre").html(response.nombres);
          $("#apellidop").html(response.apellido_paterno);
          $("#apellidom").html(response.apellido_materno);
          $("#fecha_nacimiento").html(response.fecha_nacimiento.date.slice(0, 10));
          $("#telefono").html(response.telefono);
          $("#direccion").html(response.direccion);
          $("#distrito").html(response.distrito);
          $("#estado_civil").html(response.estado_civil);
          $("#sexo").html(response.sexo);
        }
    }
});
})
</script>

<script>
  // Obtén el elemento del campo de entrada
  const numeroInput = document.getElementById('dni');

  // Agrega un controlador de eventos para el evento "input"
  numeroInput.addEventListener('input', function() {
    // Elimina cualquier carácter que no sea un número o que exceda los 8 caracteres
    this.value = this.value.replace(/[^0-9]/g, '').substring(0, 8);
  });
</script>
<script type="module" src="./assets/js/script.js"></script>
</body>
</html>