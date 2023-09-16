<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $tarefa = new Tarefa('','','','','','');
        $lista = $tarefa->select('*', "id = $id");
    }

    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    $table = "tarefa";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>projetos</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <section style="padding-top: 3.4em;">
        <form method="post" style="padding-left: .5em;">
            <h1>Pesquisar Tarefas por Nome:</h1>
            <div class="col-auto">
                <div class="input-group">
                    <div class="input-group-text border border-dark rounded-start">Nome da tarefa:</div>
                    <input type="text" name="procurar" id="procurar" size="25" value="<?php echo $procurar;?>" class="form-control-sm border border-dark rounded-end">
                    <button name="acao" id="acao" type="submit" style="background-color: #a13854;border:none;color:#fff;margin-left: 0.5em;" class="btn btn-dark rounded">Pesquisar</button>
                </div>
            </div>
            <br>
        </form>
        <div style="padding-left: .5em; padding-right: .5em;" class="table-responsive">
            <table class="table table-light table-striped table-bordered border-dark">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">Titulo da Tarefa</th>
                        <th scope="col">Data da Tarefa</th>
                        <th scope="col">Descrição da Tarefa</th>
                        <th scope="col">Prioridade da Tarefa</th>
                        <th scope="col">Nome da Matéria</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $lista = Tarefa::listar(2, $procurar);
                        foreach ($lista as $linha) {
                            $hex = $linha['cor_materia'];
                            list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
                            echo "  <tr>
                                        <th scope='row'>".$linha['titulo_tarefa']."</th>
                                        <th scope='row'>".date('d/m/Y',strtotime($linha['data_tarefa']))."</th>
                                        <th scope='row'>".$linha['descricao_tarefa']."</th>
                                        <th scope='row'>"?><?php if($linha['prioridade_tarefa'] == 1){echo "Alta";}elseif($linha['prioridade_tarefa'] == 2){echo "Média";}else{echo "Baixa";} ?><?php echo"</th>
                                        <th scope='row' style='background-color: rgba(".$r.",".$g.",".$b.",0.6);'>".$linha['nome_materia']."</th>
                                        <th scope='row'><a href='cadTarefa.php?id=".$linha['id']."'><img src='../../img/edit.svg' alt=''></a></th>
                                        <th scope='row'>"?><a onclick ="return confirm('Deseja mesmo excluir?')" href='cadTarefa.php?id=<?php echo $linha['id']; ?>&acao=excluir'><?php echo"<img src='../../img/trash-2.svg' alt=''></a></th>
                                    </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="../../css/bootstrap-5.3.1/dist/js/bootstrap.bundle.js"></script>
</body>
</html>
