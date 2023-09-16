<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $tarefa = new Tarefa('','','','','','');
        $lista = $tarefa->select('*', "id = $id");
    }

    $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
    $data = isset($_POST["data"]) ? $_POST["data"] : "";
    $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
    $prioridade = isset($_POST["prioridade"]) ? $_POST["prioridade"] : "";
    $idmateria = isset($_POST["idmateria"]) ? $_POST["idmateria"] : "";
    $table = "tarefa";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $tarefa = new Tarefa("", $titulo, $data, $descricao, $prioridade, $idmateria);
            $tarefa->inserir();
            header("location:tarefas.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    }elseif($acao == "editar"){
        try{
            $tarefa = new Tarefa($id, $titulo, $data, $descricao, $prioridade, $idmateria);
            $tarefa->editar();
            header("location:tarefas.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    }elseif($acao == "excluir"){
        try{
            $tarefa = new Tarefa($id,"","","","","");
            $tarefa->excluir();
            header("location:tarefas.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    }

    $pdo = Database::iniciaConexao();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap-5.3.1/dist/css/bootstrap.css">
    <script>
        const changeThemeToDark = () => {
            document.documentElement.setAttribute("data-theme", "dark");
            localStorage.setItem("data-theme", "dark");
        }

        const changeThemeToLight = () => {
            document.documentElement.setAttribute("data-theme", "light");
            localStorage.setItem("data-theme", 'light');
        }
        let theme = localStorage.getItem('data-theme');
        if (theme == 'dark') changeThemeToDark();
    </script>
    <title>Cadastrar</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <section class="container" style="justify-content: center; align-items:center;display:flex;padding-top:12.5%">
        <div style="background-color: blue;width: 37%;height: 35%;">
            <form action="<?php if(isset($_GET['id'])) { echo "cadTarefa.php?id=$id&acao=editar";} else {echo "cadTarefa.php?acao=insert";}?>" method="POST" style="padding-left: .5em;">
                <div class="mb-0 row justify-content-center">
                    <div class="col-lg-auto col-md-auto col-sm-auto col-xs-12">
                        <h2 style="color:white;">Cadastrar Tarefa</h2>
                    </div>
                </div>
                <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
                <div class="mb-0 row justify-content-between">
                    <div class="col-lg-auto col-md-auto col-sm-auto col-xs-12">
                        <label for="titulo" class="col-form-label" style="color: white;">Titulo da Tarefa</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="titulo" name="titulo" value="<?php if (isset($id)) echo $lista[0]['titulo_tarefa'];?>" autocomplete="off" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="mb-0 row justify-content-between">
                    <div class="col-lg-auto col-md-auto col-sm-auto col-xs-12">
                        <label for="data" class="col-form-label" style="color: white;">Data da Tarefa</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <input type="date" id="data" name="data" value="<?php if (isset($id)) echo $lista[0]['data_tarefa'];?>" autocomplete="off" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="mb-0 row justify-content-between">
                    <div class="col-lg-auto col-md-auto col-sm-auto col-xs-12">
                        <label for="descricao" class="col-form-label" style="color: white;">Descrição da Tarefa (Opcional)</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="descricao" name="descricao" value="<?php if (isset($id)) echo $lista[0]['descricao_tarefa'];?>" autocomplete="off" class="form-control">
                    </div>
                </div>
                <br>
                <div class="mb-0 row justify-content-between">
                    <div class="col-lg-auto col-md-auto col-sm-auto col-xs-12">
                        <label for="prioridade" class="col-form-label" style="color: white;">Prioridade da Tarefa</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <select id="prioridade" name="prioridade" value="" autocomplete="off" required class="form-select">
                            <option value="1" <?php if(isset($id)) {$pri = $pdo->query("SELECT prioridade_tarefa FROM tarefa WHERE id = $id;"); if(implode("",$pri->fetch(PDO::FETCH_ASSOC)) == 1){ echo "selected";}} ?>>Alta</option>
                            <option value="2" <?php if(isset($id)) {$pri = $pdo->query("SELECT prioridade_tarefa FROM tarefa WHERE id = $id;"); if(implode("",$pri->fetch(PDO::FETCH_ASSOC)) == 2){ echo "selected";}} ?>>Média</option>
                            <option value="3" <?php if(isset($id)) {$pri = $pdo->query("SELECT prioridade_tarefa FROM tarefa WHERE id = $id;"); if(implode("",$pri->fetch(PDO::FETCH_ASSOC)) == 3){ echo "selected";}} ?>>Baixa</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="mb-0 row justify-content-between">
                    <div class="col-lg-auto col-md-auto col-sm-auto col-xs-12">
                        <label for="idmateria" class="col-form-label" style="color: white;">Matéria da Tarefa</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <select id="idmateria" name="idmateria" value="" autocomplete="off" <?php if(!isset($id)) { echo "required";} else { echo "";} ?> class="form-select">
                        <?php
                            $consulta = $pdo->query("SELECT * FROM materia;");
                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option name="" value="<?php echo $linha['idmateria'];?>"<?php $sel = $pdo->query("SELECT tarefa.idmateria FROM materia, tarefa WHERE tarefa.idmateria = materia.idmateria;"); if($linha['idmateria'] == implode("",$sel->fetch(PDO::FETCH_ASSOC))){ echo "selected";} ?>><?php echo $linha['nome_materia'];?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row" style="padding-bottom: .5em;">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                        <button type="submit" value="cadastrar" class="submit" name="enviar" id="enviar" >Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="../../css/bootstrap-5.3.1/dist/js/bootstrap.bundle.js"></script>
</body>
</html>
