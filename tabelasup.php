<?php 
require_once "conexao.php";

session_start();

$sql = "SELECT * FROM teste";
$result = mysqli_query($conexao,$sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Aluno</title>
 <?php require_once "head.php";  ?>
</head>
<body>

<div class="table-responsive" id="tabdados">

<table class="table table-hover table-bordered" id="table">

  <thead class="table-secondary" id="theader">
    <tr>
      <th scope="col">Ações</th>
      <th scope="col">Nome</th>
      <th scope="col">E-mail</th>
      <th scope="col">Município</th>
      <th scope="col">Bairro</th>
      <th scope="col">Sexo</th>
      <th scope="col">Contato</th>
      <th scope="col">Nascimento</th>
      <th scope="col">Número-BI</th>
    </tr>
  </thead>
  <tbody>
      <?php while($lista = mysqli_fetch_assoc($result)) { ?>
     <tr id="tr">
      <td>
        <a href="aluno-editar.php?id=<?php echo $lista['id']; ?>">
          <button id="editar" type="button" class="btn btn-warning">Editar</button>
        </a>
      </td>   
      <td><?php echo $lista['nome']; ?></td>
      <td><?php echo $lista['email']; ?></td>
      <td><?php echo $lista['municipio']; ?></td>
      <td><?php echo $lista['bairro']; ?></td>
      <td><?php echo $lista['sexo']; ?></td>
      <td><?php echo $lista['contato']; ?></td>
      <td><?php echo $lista['dataNascimento']; ?></td>
      <td><?php echo $lista['numeroBI']; ?></td>
    </tr>

  <?php } ?>
  </tbody>
</table>
</div>

</body>
</html>