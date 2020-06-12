

<?php
  include '../banco/conexao.php';
  $conectar = getConnection();
?>

<?php 

    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_TIME, "pt_BR");
            
    $agora = getdate();

    $a = $agora["year"];
    $m = $agora["mon"];//utf8_encode(strftime("%B"));
    $d = $agora["mday"];
 
    $created = $a . "-" . $m . "-" . $d;
?>

<?php 

    if (isset($_POST["SendCadImg"])) {
        $titulo = $_POST["titulo"];

        $consulta = "INSERT INTO playlist (titulo, created) VALUES (:titulo, :created)";
     
        $salvar = $conectar->prepare($consulta);
        $salvar->bindParam(':titulo', $titulo);
        $salvar->bindParam(':created', $created);

        //Verificar se os dados foram inseridos com sucesso
        if ($salvar->execute()) {       
            header("Location: ../view/index.php");
        }
    }
    
 
    if (isset($_POST['adicionarFilme'])) {

        $filme = $_POST["filme"];
        $ano = $_POST["ano"];
        $genero = $_POST["genero"];
        $link = $_POST["link"];
        $hashtag = $_POST["hashtag"];

        $consulta = "INSERT INTO filme (filme, ano, genero, link, hashtag) VALUES (:filme, :ano, :genero, :link, :hashtag)";
     
        $salvar = $conectar->prepare($consulta);
        $salvar->bindParam(':filme', $filme);
        $salvar->bindParam(':ano', $ano);
        $salvar->bindParam(':genero', $genero);
        $salvar->bindParam(':link', $link);
        $salvar->bindParam(':hashtag', $hashtag);

        //Verificar se os dados foram inseridos com sucesso
        if ($salvar->execute()) {       
            header("Location: ../view/filmes.php");
        }
    }
?>