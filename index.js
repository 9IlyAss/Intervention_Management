$(document).ready(function()
{

  // controle hovered class
  let list = $("li");

  function activeLink() {
  list.each((item) => {
      item.removeClass("hovered");
    });
    this.addClass("hovered");
  }
  list.each((item) => item.mouseenter(activeLink));
  
  //============================================================
        //display

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
  
    console.log("jQuery is working!");
  
  
})

      