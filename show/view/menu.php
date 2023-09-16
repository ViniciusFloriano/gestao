<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="color: white;">
  <div class="container-fluid">
    <span class="navbar-brand"></span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#links-Menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="links-Menu" class="collapse navbar-collapse justify-content-between">
      <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
            Matérias
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="cadMateria.php">Cadastrar Matérias</a></li>
            <li><a class="dropdown-item" href="materias.php">Ver Matérias</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
            Tarefas
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="cadTarefa.php">Cadastrar Tarefas</a></li>
            <li><a class="dropdown-item" href="tarefas.php">Ver Tarefas</a></li>
          </ul>
        </li>
      </ul>
      <div class="d-flex">
        <div class="form-check form-switch me-2">
            <input type="checkbox" name="toggle-dark" id="toggle-dark" class="form-check-input" role="switch">
        </div>
      </div>
    </div>
  </div>
</nav>
<script src="../../js/script.js"></script>
