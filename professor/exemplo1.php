<?php

require_once "../conexao.php";
  
$aluno = password_hash('aluno', PASSWORD_DEFAULT);
$admin = password_hash('admin', PASSWORD_DEFAULT);
$encarregado = password_hash('encarregado', PASSWORD_DEFAULT);
$professor= password_hash('professor', PASSWORD_DEFAULT);

mysqli_query($conexao,"UPDATE sg_usuarios SET senha_u = '$aluno' WHERE id_u = '17' ");


    /* $valor = mysqli_query($conexao,"SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno = '1' AND id_trimestre = '1' ");

      while($area = mysqli_fetch_assoc($valor)) { 
          $v[] = $area['mediaF']; 
           
      }


    $valor1 = mysqli_query($conexao,"SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno = '1' AND id_trimestre = '2' ");

      while($area1 = mysqli_fetch_assoc($valor1)) { 
          $v1[] = $area1['mediaF'];          
          
      }


   $valor2 = mysqli_query($conexao,"SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno = '1' AND id_trimestre = '3' ");

      while($area2 = mysqli_fetch_assoc($valor2)) { 
          $v2[] = $area2['mediaF'];
          $disc[] = $area2['nome_d'];   
          
      }

      var_dump($v).'<br>'.'<hr>';
      var_dump($v1).'<br>'.'<hr>';
      var_dump($v2).'<br>'.'<hr>';
      var_dump($disc).'<br>'.'<hr>';


   for($c = 0; $c < count($v); $c++){
   	  echo number_format($v[$c],2).' +' .$v1[$c].' + '.$v2[$c].'<br>';
   }
*/

 ?>