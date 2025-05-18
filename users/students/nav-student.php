<!DOCTYPE html>
<html>
<body>
  <div class="navegacao">
    <ul>
      <li class="list active">
        <a href="home.php">
          <span class="icon"><img src="../../img/home_white_24dp.svg"></span>
          <span class="title">HOME</span>
        </a>
      </li>
      <li class="list">
        <a href="notes.php">
          <span class="icon"><img src="../../img/perm_identity_white_24dp.svg"></span>
          <span class="title">Notas-Trimestrais</span>
        </a>
      </li>
      <li class="list">
        <a href="#">
          <span class="icon"><img src="../../img/format_list_numbered_white_24dp.svg"></span>
          <span class="title">Exame</span>
        </a>
      </li>
      <li class="list">
        <a href="average.php">
          <span class="icon"><img src="../../img/format_list_numbered_white_24dp.svg"></span>
          <span class="title">Resultado-final</span>
        </a>
      </li>
      <li class="list">
        <a href="settings.php">
          <span class="icon"><img src="../../img/settings.png"></span>
          <span class="title">Alterar-senha</span>
        </a>
      </li>
      <li class="list">
        <a href="../../logoult.php">
          <span class="icon"><img src="../../img/logout_white_24dp.svg"></span>
          <span class="title">Sair</span>
        </a>
      </li>
    </ul>
  </div>
</body>
<script>
  let file = window.location.pathname.split("/").pop();
  let lis = document.querySelectorAll("li");
  let links = document.querySelectorAll("a");
  
  lis.forEach((li)=>{
      li.setAttribute("class","list");
  });

  links.forEach((link)=>{
    if(file === link.getAttribute("href"))
      link.parentElement.setAttribute("class","list active");
  });
</script>
</html>