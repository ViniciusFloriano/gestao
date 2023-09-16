<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $materia = new Materia('','','','');
        $lista = $materia->select('*', "idmateria = $id");
    }

    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $professor = isset($_POST["professor"]) ? $_POST["professor"] : "";
    $cor = isset($_POST["cor"]) ? $_POST["cor"] : "";
    $table = "materia";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $materia = new Materia("", $nome, $professor, $cor);
            $materia->inserir();
            header("location:materias.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    }elseif($acao == "editar"){
        try{
            $materia = new Materia($id, $nome, $professor, $cor);
            $materia->editar();
            header("location:materias.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    }elseif($acao == "excluir"){
        try{
            $materia = new Materia($id, "", "", "");
            $materia->excluir();
            header("location:materias.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    }
?>
<html data-theme="light">
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
        <div style="background-color: blue;width: 32%;height: 35%;">
            <form action="<?php if(isset($_GET['id'])) { echo "cdMateria.php?id=$id&acao=editar";} else {echo "cadMateria.php?acao=insert";}?>" method="POST" style="padding-left: .5em;">
                <div class="mb-0 row justify-content-center">
                    <div class="col-lg-auto col-md-auto col-sm-auto col-xs-12">
                        <h2 style="color:white;">Cadastrar Matéria</h2>
                    </div>
                </div>
                <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['idmateria'];?>">
                <div class="mb-0 row justify-content-between">
                    <div class="col-lg-auto col-md-auto col-sm-auto col-xs-12">
                        <label for="nome" class="col-form-label" style="color: white;">Nome da Matéria</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nome" name="nome" value="<?php if (isset($id)) echo $lista[0]['nome_materia'];?>" autocomplete="off" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="mb-0 row justify-content-between">
                    <div class="col-lg-auto col-md-auto col-sm-auto col-xs-12">
                        <label for="professor" class="col-form-label" style="color: white;">Nome do Professor</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="professor" name="professor" value="<?php if (isset($id)) echo $lista[0]['professor_materia'];?>" autocomplete="off" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="mb-0 row justify-content-between">
                    <div class="col-lg-auto col-md-auto col-sm-auto col-xs-12">
                        <label for="cor" class="col-form-label" style="color: white;">Cor da Matéria (Opcional)</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <input type="color" id="cor" name="cor" value="<?php if (isset($id)) echo $lista[0]['cor_materia'];?>" autocomplete="off" class="form-control">
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
