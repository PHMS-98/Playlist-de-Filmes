
<?php
  include '../banco/conexao.php';
  $conectar = getConnection();
?>

<?php
  // Consulta ao banco de dados
  $listagem = "SELECT id_filme,filme, ano, genero, link,hashtag ";
  $listagem .= "FROM filme ";

  if ( isset($_GET["buscar"]) ) {
      $procurar = $_GET["buscar"];
      $listagem .= "WHERE hashtag LIKE '%{$procurar}%'";
  }
  
  $consulta = $conectar->prepare ($listagem);
  $consulta->execute();
?>


<!DOCTYPE html>
<html>
<head>
	<title> Filme </title>

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
  	h1 {
		  color: black;
		  padding-left: 25px;
		  font-family: "Courier New", Courier, monospace;
		}

	#FormPesquisar{
		padding-left: 600px;
	}

	#buscar{
		width: 300px;
	}

	div.contagem{
      width: 2000px;
      padding-left: 10px;
      padding-right: -50px;
    }
	
	#inputFilme{
	    width: 350px;
	    padding-left: 15px;
  	}

  	#inputAno{
	    width: 120px;
	    padding-left: 15px;
  	}

  	#inputLink{
	    width: 465px;
	    padding-left: 0px;
  	}

    #selectgenero{
      padding-left: 15px;
      width: 240px;
    }

    #lblGenero{
    	padding-left: 15px;
    }
  </style>

</head>


<body> <br><br>

<div class="form-row"> 
	<label>
	   <h1>
	   		Filmes
		<!-- Button trigger modal -->
		<button type="button" id="AddFilme" class="btn btn-link" data-toggle="modal" data-target="#exampleModal">
		  	<img class="botaoAdicionar" src="../img/adicionar.png" width="30" height="30">
		</button>
		</h1>
	</label>

          <!-- IMAGEM  <img src="../img/romance.png"> -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filme</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="../model/salvar.php">
          <div class="form-row"> <!-- ID do Espaco-->
                  <label> Nome do Filme: </label>
                  <div id="inputFilme">
                  <input type="text" name="filme" class="form-control">
                  </div>
          </div>        
          <br>

          <div class="form-row"> <!-- ID do Espaco-->
                  <label> Ano: </label>
                  <div id="inputAno">
                  <input type="number" name="ano" class="form-control" min="1900" max="2030">
                  </div>

		<Label id="lblGenero">Gênero: </Label><br>
			<div id="selectgenero"> 
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
		</div>	      
          <br>

          <div class="form-row"> <!-- ID do Espaco-->
                  <label> Link: </label>
                  <div id="inputLink">
                  <input type="text" name="link" class="form-control">
                  </div>
          </div>        
          <br>

          <div class="form-row"> <!-- ID do Espaco-->
                  <label> Hashtag: </label>
                  <div id="inputLink">
                  <input type="text" name="hashtag" class="form-control">
                  </div>
          </div>

          <br>  
            <center> 
              <button type="submit" class="btn btn-success" id="adicionarFilme" name="adicionarFilme">
                Adicionar Filme
              </button>  
            </center>  
        </form>
        </div>         
      </div>      
    </div>
  </div>

<div id="FormPesquisar"> 
		<form action="filmes.php" method="GET" class="form-inline my-2 my-lg-0">
		    <div class="form-group">
		        <input id="buscar" class="form-control" type="text" name="buscar" placeholder="#hashtag"/>
		    <!--    <input class="form-control" type="text" name="data" placeholder="xxxx-xx-xx"/> -->
		    </div>
		    <div class=text-right>
		        <input type="image" src="../img/pesquisar.png" class="btn btn-default" width="50" height="40" />
		    </div>
    	</form>
</div>

</div>


      <?php
  echo"<table class='table table-sm table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th><center>Filme</center></th>";
    echo "<th><center>Ano</center></th>";
    echo "<th><center>Gênero</center></th>";
    echo "<th><center>Link</center></th>";
    echo "<th><center>Açöes</center></th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {   
?> 
    <tr>
    <td> <center> <?php echo $linha["filme"] ?> </center> </td>
    <td> <center> <?php echo $linha["ano"] ?> </center> </td>
    <td> <center> <?php echo $linha["genero"] ?> </center> </td>
    <td> <center> <?php echo $linha["link"] ?> </center> </td>
    <td>   
    	<center>
    	<a href="#edit<?php echo $linha['id_filme'];?>" data-toggle="modal">
	    	<img class="botaoRemover" src="../img/editar.png">
	    <!--  <button type='button' class="btn btn-warning btn-sm"> Editar </button> -->
	    </a>


	    <!--Edit Item Modal -->
	                    <div id="edit<?php echo $linha['id_filme']; ?>" class="modal fade" role="dialog">
	                        <form method="post" class="form-horizontal" action="../model/editar.php">
	                            <div class="modal-dialog modal-lg">
	                                <!-- Modal content-->
	                                <div class="modal-content">
	                                    <div class="modal-header">
	                                        <h3>Editar</h3>
	                                        <button class="close" data-dismiss="modal">
	                                            <span>&times;</span>
	                                        </button>
	                                    </div>
	                                                    
	                                    <div class="modal-body">
	                                        <input type="hidden" name="edit_item_id" value="<?php echo $linha['id_filme']; ?>">
	                                        <div class="form-row">
	                                          <label class="control-label col-sm-2">Filme:</label>
	                                            <input type="text" class="form-control" value="<?php echo $linha['filme']; ?>" id="filme" name="filme"> 
	                                        </div>

	                                        <div class="form-row">
	                                          <label class="control-label col-sm-2">Gênero:</label>
	                                            <input type="text" class="form-control" value="<?php echo $linha['genero']; ?>" id="genero" name="genero"> 
	                                        </div>

	                                        <div class="form-row">
	                                          <label class="control-label col-sm-2">Ano:</label>
	                                            <input type="text" class="form-control" value="<?php echo $linha['ano']; ?>" id="ano" name="ano"> 
	                                        </div>

	                                        <div class="form-row">
	                                          <label class="control-label col-sm-2">Link:</label>
	                                            <input type="text" class="form-control" value="<?php echo $linha['link']; ?>" id="link" name="link"> 
	                                        </div>  
	                                    </div>

	                                    <div id='botao'>
	                                    <button type="submit" class="btn btn-success" name="editar_filme"> 
	                                            Atualizar
	                                    </button>

	                                  </div>
	                                  <br>
	                                </div>
	                                </div>
	                        </form>
	                    </div>

    	<a class="btn btn-link" href="../model/deletar.php?id=<?php echo $linha["id_filme"]?>" role="button" name="deletarFilme">
          <img class="botaoRemover" src="../img/remover.png">
        </a>

        </center>
    </td>
    </tr>

<?php
  }
  echo "</tbody>";
  echo "</table>";

?>

<br><br><br>

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