let file = window.location.pathname.split("/").pop();
let list = [...document.querySelectorAll("li")]; 
let routes = [
  ['home.php'],
  ['notes.php', 'quarter.php'],
  ['average.php'],
  ['settings.php'],
];
let count = 0;

list.forEach((link)=>{
  if(routes[count].includes(file))
    link.setAttribute("class","list active");
  else
    link.setAttribute("class","list");
  count++;
});