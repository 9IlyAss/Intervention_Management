$(document).ready(function()
{
  // controle hovered class
  let list = document.querySelectorAll("li");

  function activeLink() {
  list.forEach((item) => {
      item.classList.remove("hovered");
    });
    this.classList.add("hovered");
  }
  
  list.forEach((item) => item.addEventListener("mouseover", activeLink));
  
  //============================================================
        //display
    
  // let navlinks=document.querySelectorAll(".navigation a");
  // let content =document.querySelectorAll(".content");
  // function navigation()
  // {
    
  //   navlinks.forEach((link)=>
  //     {
  //       link.addEventListener("click",()=> 
  //         {
  //           let item=link.getAttribute('href').substring(1);
  //           content.forEach((element)=>
  //             {
  //               element.style.display="none";
  //             });
  //             document.getElementById(item).style.display="block";
  //         });
          
  //     });
  // }
  // navigation();
  //=================================================================
  // let navlinks=$(".sidebar a");
  // let content =$(".title");
  // function navigation()
  // {
  //   navlinks.each((link)=>
  //     {
  //       link.click(()=>
  //       {
  //         var attr=link.attr('href').substring(1);
  //         $("content").empty().append("<?php include 'pages/${attr}.html';?>");
  //       })
  //     }
  //   )
  // }
  // navigation();
  //===================================================================
      // in progress + done
  
  function inprogress()
  {
      let exist=document.getElementById('pending');
    if(!exist)
      {
        let mess=document.createElement('textarea');
        mess.rows='4';
        mess.placeholder='Enter progress details...';
        mess.id='pending';
        let progress =document.getElementById("Progresslabel");
        progress.insertAdjacentElement('afterend',mess);
      }
    else
      {
        document.getElementById('progressRadio').checked = false;
        exist.remove();
      }
    
  }
  
  
  function done()
  {
    let exist=document.getElementById('pending');
    if(exist)
    exist.remove();
  }
  
  //=========================================================================
  
  
  
  
})

      