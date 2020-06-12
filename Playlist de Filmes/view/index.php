

<?php
  include '../banco/conexao.php';
  $conectar = getConnection();
?>

<?php

// Consulta ao banco de dados
  $listagem = "SELECT id_playlist,titulo ";
  $listagem .= "FROM playlist";
  
  $consulta = $conectar->prepare ($listagem);
  $consulta->execute();

  if (!$consulta) {
    die("Erro no Banco");
  }

?>


<!DOCTYPE html>
<html>
<head>
	<title> Principal </title>

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
        
<!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filmes
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="cadastrar_espaco.php">Adicionar Filme</a>
            <a class="dropdown-item" href="espacos.php">Listagem</a>
          </div>
        </li>
-->
      </ul>
    </div>
  </nav>

	<style type="text/css">	
		h1 {
		  color: black;
		  padding-left: 25px;
		  font-family: "Courier New", Courier, monospace;
		}

		div.form-row{
			width: 400px;
		}

    #criar{
      width: 300px;
    }

    hr{
      border-color: gray;
      border-style: solid;
      border-width: 01px;
      width: 1250px;
    }

  div.listagem{
    float: center;
    padding-left: 150px;
    padding-right: 150px;
  }

  div.listando{
    position: relative;
    width: 200px;
    height: 160px;
    float: left;
  }

  a.btn {
    position: relative;
    width: 30px;
    padding-right: 7px;
    padding-left: 4px;
  }

  img.botaoCancelar {
  /*  position: relative; */
    width: 32px;
  /*  padding-right: 5px; */
  }
  img.botaoEditar {
  /*  position: relative; */
    width: 32px;
  /*  padding-left: 5px; */
  }

  #inputTitulo{
    width: 200px;
    padding-left: 15px;
  }

	</style>

</head>


<body>

<br>
<div class="form-group">
	<label>
		<h1>Playlist</h1>
	</label>	

<!-- Button trigger modal -->
<button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal">
  adicionar
</button>
</div>

          <!-- IMAGEM  <img src="../img/romance.png"> -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Criar Playlist</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="../model/salvar.php">
          <div class="form-row"> <!-- ID do Espaco-->
                  <label> Nome da Playlist: </label>
                  <div id="inputTitulo">
                  <input type="text" name="titulo" class="form-control">
                  </div>
          </div>        
          <br>  
            <center> 
              <button type="submit" class="btn btn-success" id="criar" name="SendCadImg">
                Criar
              </button>  
            </center>  
        </form>
        </div>         
      </div>      
    </div>
  </div>


<?php
  while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
?>
<div class="listagem">
  <div class="listando">  
    <br>     
    <center>
      <a href="playlist.php?id=<?php echo $linha['id_playlist'] ?>">
        <img src="../img/playlist.png" width="90" height="80">
      </a>
    <br>
      <b>        
         <?php echo $linha["titulo"] ?>       
      </b> 
      <br>         
        <a class="btn btn-link" href="../model/deletar.php?id=<?php echo $linha["id_playlist"]?>" role="button" name="deletar">
          <img class="botaoCancelar" src="../img/apagar.png">
        </a>

        <a class="btn btn-link" href="index_atualizar.php?id=<?php echo $linha["id_playlist"]?>" role="button" name="editar">
          <img class="botaoEditar" src="../img/atualizar.png">
        </a>
    </center>
  </div>     
</div>
<?php
  }
?>
<!--
<?php
  while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
?>
 
    <br>
      <a href="playlist.php?id=<?php echo $linha['id'] ?>">
        <img src="../img/Claquete.png">
      </a>
    <br> 
      <b>
       <?php echo $linha["titulo"] ?>
      </b> 
    <br> 

<?php
  }
?> 
-->

</body>

<!-- Código para o modal funcionar-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/bootnavbar.js" ></script>
    <script>
        $(function () {
            $('#main_navbar').bootnavbar();
        })
    </script>


</html>