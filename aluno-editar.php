<?php
require_once "connection.php";
require_once "features/getData.php";
session_start();

$student_id = $_POST['student_id'];
$_SESSION['student_id'] = $student_id;

$sql_student = "SELECT * FROM sg_aluno AS a join sg_classe AS c ON c.id_c = a.idClasse join sg_turma AS t ON a.idTurma_a = t.id_t WHERE id_a =?";
$student_data = getData($connection, $sql_student, [$student_id]);
$city_array = ["Luanda", "Viana", "Belas", "Cazenga", "Kissama", "Kilamba Kiaxi", "Talatona", "Cacuaco", "Icolo e Bengo"];
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
        <h5>Editar dados do aluno</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <div class="navegacao">
    <ul>
      <li class="list">
        <a href="menu-home.php">
          <span class="icon"><img src="img/home_white_24dp.svg"></span>
          <span class="title">HOME</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-professores.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Professores</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-Encarregados.php">
          <span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
          <span class="title">Encarregados</span>
        </a>
      </li>
      <li class="list active">
        <a href="menu-alunos.php">
          <span class="icon"><img src="img/school_white_24dp.svg"></span>
          <span class="title">Alunos</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-usuarios.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Usuarios</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-disciplinas.php">
          <span class="icon"><img src="img/livro.png"></span>
          <span class="title">Disciplinas</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-turmas.php">
          <span class="icon"><img src="img/edit.png"></span>
          <span class="title">Turmas</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-classes.php">
          <span class="icon"><img src="img/edit.png"></span>
          <span class="title">Classes</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-gerenciar.php">
          <span class="icon"><img src="img/gerenciar.png"></span>
          <span class="title">Gerenciamento</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-configurar.php">
          <span class="icon"><img src="img/settings.png"></span>
          <span class="title">Alterar-senha</span>
        </a>
      </li>
      <li class="list">
        <a href="logoult.php">
          <span class="icon"><img src="img/logout_white_24dp.svg"></span>
          <span class="title">Sair</span>
        </a>
      </li>
    </ul>
  </div>

  <?php require_once "navbarMobile.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Editar dados do aluno</h5>
    </div>
    <form action="aluno-editar-processar.php" method="post">
      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="name" value="<?= $student_data['nome_a']; ?>">
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textclasse">Classe</label>
          <select id="textclasse" class="input form-control" name="class" required>
            <option value="<?= $student_data['idClasse'] ?>"><?= $student_data['nome_c']; ?></option>
            <?php
            $class_data = getData($connection, "SELECT id_c, nome_c FROM sg_classe");
            foreach ($class_data as $class) {
              echo "<option value = '" . $class['id_c'] . "'>" . $class['nome_c'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textturma">Turma</label>
          <select id="textturma" class="input form-control" name="group" required>
            <option value="<?= $student_data['idTurma_a'] ?>"><?= $student_data['nome_t']; ?></option>
            <?php
            $group_data = getData($connection, "SELECT id_t,nome_t FROM sg_turma");
            foreach ($group_data as $group) {
              echo "<option value = '" . $group['id_t'] . "'>" . $group['nome_t'] . "</option>";
            }
            ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textmun">Município</label>
          <select id="textmun" class="input form-control" name="city" placeholder="Seu município" required>
            <option value="<?= $student_data['municipio_a'] ?>"><?= $student_data['municipio_a'] ?></option>
            <?php
            foreach ($city_array as $city) {
              if ($city !== $student_data['municipio_a']) { ?>
                <option value="<?= $city ?>"><?= $city ?></option>
              <?php }
            } ?>
          </select>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textbairro">Bairro</label>
          <input type="text" id="textbairro" class="form-control" name="neighborhood"
            value="<?= $student_data['bairro_a']; ?>">
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textsexo">sexo</label>
          <select type="text" id="textsexo" class="input md form-control" name="gender"
            value="<?= $student_data['sexo_a']; ?>" required>
            <?php
            if ($student_data['sexo_a'] == 'Masculino') {
              ?>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            <?php } else { ?>
              <option value="<?= $student_data['sexo_a']; ?>">Femenino</option>
              <option value="Masculino">Masculino</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textcont">Contato</label>
          <input type="text" id="textcont" class="form-control" name="contact"
            value="<?= $student_data['contato_a']; ?>">
        </div>
        <div class="form-group col-md-4" id="margemB">
          <label for="textnasc">Data de Nascimento</label>
          <input type="date" id="textnasc" class="form-control" name="birthday"
            value="<?= $student_data['nascimento_a']; ?>">
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textbi">Número do BI</label>
          <input type="text" id="textbi" class="form-control" name="BI" value="<?= $student_data['numeroBI_a']; ?>">
        </div>
      </div>

      <div class="row">
        <?php
        $responsible_data = getData($connection, "SELECT * FROM sg_encarregado AS e INNER JOIN sg_aluno AS a ON e.id_e = a.idEncarregado WHERE id_a = ?", [$student_id]);
        ?>
        <div class="form-group col-md-6 mb-3">
          <label for="textencarregado">Encarregado</label>
          <input type="text" readonly id="textencarregado" class="form-control" name="responsible_id" maxlength="45"
            value="<?= $responsible_data['nome_e']; ?>" required>
        </div>
      </div>

      <div class="row" id="marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-update"
          id="margemBotao">Gravar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-alunos.php" class="btn btn-outline-secondary btn-block col-md-2" name="cadastramento">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>