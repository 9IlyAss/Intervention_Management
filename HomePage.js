      // controle hovered class
let list = document.querySelectorAll(".navigation li");

function activeLink() {
list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

//============================================================
      //display
  
let navlinks=document.querySelectorAll(".navigation a");
let content =document.querySelectorAll(".content");
function navigation()
{
  
  navlinks.forEach((link)=>
    {
      link.addEventListener("click",()=> 
        {
          let item=link.getAttribute('href').substring(1);
          content.forEach((element)=>
            {
              element.style.display="none";
            });
            document.getElementById(item).style.display="block";
        });
        
    });
}
navigation();

//===================================================================






