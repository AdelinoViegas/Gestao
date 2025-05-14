<?php
require_once "connection.php";
require_once "features/getData.php";
session_start();

if (!isset($_SESSION['logged']))
  header("Location: index.php");

$data = getData($connection, "SELECT * FROM sg_encarregado WHERE view = '1' ORDER BY nome_e");

if (isset($_POST['btn-search'])) {
  $search = mysqli_real_escape_string($connection, trim($_POST['search']));
  $data = getData($connection, "SELECT * FROM sg_encarregado WHERE nome_e LIKE '$search%' AND view ='1'");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
  <?php require_once "head.php"; ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>
  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Encarregados cadastrados</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['responsible-message'])) {
    echo $_SESSION['responsible-message'];
    unset($_SESSION['responsible-message']);
  }
  ?>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Encarregados cadastrados</h5>
    </div>

    <div id="divflex">
      <a href="encarregado-cadastro.php" type="button" id="adicionar" class="btn btn-secondary">
        Adicionar
      </a>

      <form action="" method="post">
        <div id="btn-pesquisar">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por nome">
          <button id="btn-p" type="submit" class="btn btn-success" name="btn-search">
            Pesquisar
          </button>
        </div>
      </form>
    </div>

    <div class="table-responsive" id="tabdados">
      <table class="table table-hover table-bordered" id="table">
        <thead class="table-secondary" id="theader">
          <tr>
            <th scope="col">Ações</th>
            <th scope="col">Nome</th>
            <th scope="col">Município</th>
            <th scope="col">Bairro</th>
            <th scope="col">Sexo</th>
            <th scope="col">Contato</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (count($data) > 0) {
            foreach ($data as $responsible_data) {
              ?>
              <tr id="tr">
                <td id="editar">
                  <form action="encarregado-editar.php" method="post">
                    <input id="editar1" type="hidden" class="btn btn-warning" value="<?= $responsible_data['id_e']; ?>"
                      name="responsible_id">
                    <button id="editar1" type="submit" class="btn btn-warning">Editar</button>
                  </form>

                  <button id="editar2" type="button" data-bs-target="#apagar<?= $responsible_data['id_e']; ?>"
                    data-bs-toggle="modal" class="btn btn-danger">Apagar</button>

                  <div class="modal fade" id="apagar<?= $responsible_data['id_e']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title custom_align text-dark" id="Heading">Eliminar Registro</h4>

                          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>

                        <div class="modal-body">
                          <div class="alert alert-danger">
                            Deseja excluir
                            <strong><?= $responsible_data['nome_e']; ?></strong> ?
                          </div>
                        </div>

                        <div class="modal-footer">
                          <form action="encarregado-apagar.php" method="post">
                            <input type="hidden" name="responsible_id" value="<?= $responsible_data['id_e']; ?>">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Sim</button>
                          </form>

                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td><?= $responsible_data['nome_e']; ?></td>
                <td><?= $responsible_data['municipio_e']; ?></td>
                <td><?= $responsible_data['bairro_e']; ?></td>
                <td><?= $responsible_data['sexo_e']; ?></td>
                <td><?= $responsible_data['contato_e']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php
          } else {
            ?>
        </tbody>
        </table>
        <tfooter class='text text-center'>
          <h5>Nenhum dado encontrado</h5>
        </tfooter>
      <?php
          }
          ?>
    </div>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>