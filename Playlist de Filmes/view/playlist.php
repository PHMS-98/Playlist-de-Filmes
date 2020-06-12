
<?php
  include '../banco/conexao.php';
  $conectar = getConnection();
?>

<?php
  // pega o ID da URL
  $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

// Consulta ao banco de dados
  $listagem = "SELECT id_playlist,titulo ";
  $listagem .= "FROM playlist WHERE id_playlist = :id";
  
  $consulta = $conectar->prepare ($listagem);
  $consulta->execute(array(':id' => $id));

  $linha = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title> Playlist </title>

  <!-- Link Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <nav class="navbar navbar-expand-lg navbar-light bg-light"> 
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Playlist</a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="filmes.php">Filmes</a>
        </li>
      </ul>
    </div>
  </nav>

  <style>

    h3 {
      color: black;
      padding-left: 15px;
      font-family: "Courier New", Courier, monospace;
    }

    #listagem{
      padding-left: 15px;
    }

    #alinhardentro{
      padding-left: 15px;
    }

    #selectgenero{
      padding-left: 15px;
      width: 210px;
    }

  </style>

</head>



<body>
<br><br>
  <h3> <?php echo $linha['titulo'] ?></h3>

  <div id="listagem">
    <label> Alinhando padding-left 15px </label>

    <div id="alinhardentro">
      Alinhando dentro do padding-left
    </div>
  </div>







<br>
<div id="selectgenero"> 
	<Label>Gênero: </Label><br>
        <select id="genero" name="genero" class="form-control">
          <option value="disable" selected=""> Escolha uma opcao</option>
          <option value="Ação"> Ação </option>
          <option value="Animação"> Animação </option>
          <option value="Biografia"> Biografia </option>
          <option value="Comédia"> Comédia </option>
          <option value="Comédia Romantica"> Comédia Romantica </option>
          <option value="Documentário"> Documentário </option>
          <option value="Drama"> Drama </option>
          <option value="Espionagem"> Espionagem </option>
          <option value="Ficção Científica"> Ficção Científica </option>
          <option value="Guerra"> Guerra </option>
          <option value="Musical"> Musical </option>
          <option value="Policial"> Policial </option>
          <option value="Romance"> Romance </option>
          <option value="Suspense"> Suspense </option>          
        </select>
</div>






</body>



    $salvar->bindParam(':genero', $genero);
    
    $genero = $_POST["genero"];

</html>