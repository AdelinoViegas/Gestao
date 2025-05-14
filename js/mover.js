const list = document.querySelectorAll(".list");

function activeLink() {
  list.forEach((item) => item.classList.remove('active'));
  this.classList.add('active');
}

list.forEach((item) => item.addEventListener('click', activeLink)
);


let fileName = window.location.pathname.split("/").pop();
let menu = document.querySelectorAll(".navegacao ul li");

menu.forEach((value) => {
  if(fileName === value.childNodes[1].getAttribute("href"))
    value.setAttribute("class", "list active");
  else
    value.setAttribute("class", "list");
});
