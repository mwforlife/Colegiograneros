$(document).ready(function() {
    $('.table').DataTable();
} );


  function kaishi()  
    {  
        var docElm = document.documentElement;  
        //W3C   
        if (docElm.requestFullscreen) {  
            docElm.requestFullscreen();  
        }  
            //FireFox   
        else if (docElm.mozRequestFullScreen) {  
            docElm.mozRequestFullScreen();  
        }  
                         // Chrome, etc.   
        else if (docElm.webkitRequestFullScreen) {  
            docElm.webkitRequestFullScreen();  
        }  
            //IE11   
        else if (elem.msRequestFullscreen) {  
            elem.msRequestFullscreen();  
        }  
    }  
  
         // Salir de pantalla completa
    function guanbi() {  
  
  
        if (document.exitFullscreen) {  
            document.exitFullscreen();  
        }  
        else if (document.mozCancelFullScreen) {  
            document.mozCancelFullScreen();  
        }  
        else if (document.webkitCancelFullScreen) {  
            document.webkitCancelFullScreen();  
        }  
        else if (document.msExitFullscreen) {  
            document.msExitFullscreen();  
        }  
    }  
  
  
     // oyente de eventos
  
    document.addEventListener("fullscreenchange", function () {  
          
        fullscreenState.innerHTML = (document.fullscreen) ? "" : "not ";  
    }, false);  
      
    document.addEventListener("mozfullscreenchange", function () {  
         
        fullscreenState.innerHTML = (document.mozFullScreen) ? "" : "not ";  
    }, false);  
     
    document.addEventListener("webkitfullscreenchange", function () {  
          
        fullscreenState.innerHTML = (document.webkitIsFullScreen) ? "" : "not ";  
    }, false);  
      
    document.addEventListener("msfullscreenchange", function () {  
          
        fullscreenState.innerHTML = (document.msFullscreenElement) ? "" : "not ";  
    }, false);  
