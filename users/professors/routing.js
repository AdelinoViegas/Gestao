let count = 0;
let file = window.location.pathname.split("/").pop();
let list = document.querySelectorAll("li"); 
let routes = [
  ['home.php'],
  ['notes-lanche.php', 'student-notes.php', 'notes-edit.php'],
  ['settings.php'],
];

list.forEach((link)=>{
  if(routes[count].includes(file))
    link.setAttribute("class","list active");
  else
    link.setAttribute("class","list");
  count++;
});