let route = [
    ["menu-home.php"], 
    ["menu-professors.php","professors-sign.php","professors-edit.php"],
    ["menu-responsibles.php","responsibles-sign.php","responsibles-edit.php"],
    ["menu-students.php","students-sign.php","students-edit.php"],
    ["menu-users.php"],
    ["menu-disciplines.php","disciplines-sign.php","disciplines-edit.php"],
    ["menu-groups.php", "groups-sign.php","groups-edit.php"],
    ["menu-class.php", "class-sign.php","class-edit.php"],
    ["menu-management.php", "management-sign.php","management-edit.php"],
    ["menu-set.php"],
    ["logoult.php"],
  ]
  
  
  let fileName = window.location.pathname.split("/").pop();
  let menu = [...document.querySelectorAll(".navegacao ul li")];
  let count = 0;
  
  menu.forEach((value) => {
    if(route[count].includes(fileName))
      value.setAttribute("class", "list active");
    else
      value.setAttribute("class", "list");
    count++;
  });