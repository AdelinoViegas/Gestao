<?php 
require_once "conexao.php";
session_start();
/*Da 1 ate 6-classe maior nota é 10valores
  Da 7 ate 9-classe maior nota é 20valores

  testando a 2-classe.
*/

        $Aval1= 0;
        $Aval2= 10 ;
        $Aval3= 0;
        $Pv1= 0;
        $Pv2= 0;
        $Mav=(($Aval1+$Aval2+$Aval3)/3)*0.5;
        $Mpv=(($Pv1+$Pv2)/2)*0.3;
        $MF= $Mav+$Mpv+0.2;
            //Buscar turma
        $Turm = mysqli_query($conexao,"SELECT * FROM sg_gerenciar AS g JOIN sg_turma AS t ON t.id_t=g.idTurma WHERE id_g ='1'");
        $vet=mysqli_fetch_assoc($Turm);
        $nomeTurma = $vet['nome_t'];

        $res = mysqli_query($conexao,"SELECT nome_t FROM sg_turma");
        while($arr = mysqli_fetch_assoc($res)){
             $vector[] = $arr['nome_t'];
        }	
     
     foreach ($vector as $val) {
     	if( !($val == '01-A') && !($val == '01-B') && !($val == '02-A') && !($val == '02-B') && !($val == '03-A') && !($val == '03-B') && !($val == '04-A') && !($val == '04-B') && !($val == '05-A') && !($val == '05-B') && !($val == '06-A') && !($val == '06-B')){
     	    $turma_secundario[] = $val;
         }

        if( !($val == '07-A') && !($val == '07-B') && !($val == '08-A') && !($val == '08-B') && !($val == '09-A') && !($val == '09-B')){
     	   $turma_primario[] = $val;
         }   
     }

  echo $MF;
 
     

function classificacao(){

  /*Ensino primario*/
       global $nomeTurma;
       global $turma_primario;
       global $turma_secundario;
       global $MF;

      if(in_array($nomeTurma,$turma_primario )){
	    if ($MF >= 5 && $MF <= 10) {
	       return "Aprovado"; 
	    }elseif($MF >= 1 && $MF < 5){
            return "reprovado";   
	    }
	
    }elseif(in_array($nomeTurma,$turma_secundario )){
        if ($MF >= 10 && $MF <= 20) {
	       return "Aprovado s"; 
	    }elseif($MF >= 1 && $MF < 10){
            return "reprovado s";   
	    }
    }
    	

}

echo '<br>'.classificacao();

?>
