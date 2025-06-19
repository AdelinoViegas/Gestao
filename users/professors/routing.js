let count = 0;
let file = window.location.pathname.split("/").pop();
let list = [...document.querySelectorAll(".navegacao ul li")]; 
let routes = [
  ['home.php'],
  ['notes-lanche.php', 'student-notes.php', 'notes-edit.php'],
  ['settings.php'],
  ['../../logoult.php'],
];

list.forEach((link)=>{
  if(routes[count].includes(file))
    link.setAttribute("class","list active");
  else
    link.setAttribute("class","list");
  count++;
});