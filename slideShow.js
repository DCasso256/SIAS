/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
window.addEventListener('load', slideShow, false);
//window.attachEvent('load', slideShow, false);  -----> para versiones anteriores a IE 9

function slideShow() {
  
  /* GLOBALS **********************************************************************************************/
  
  var globals = {
    slideDelay: 4000, // Intervalo de tiempo entre diapositivas consecutivas.
    fadeDelay: 35, // Intervalo de tiempo entre los cambios individuales de opacidad. Siempre debe ser más pequeño que slideDelay..  
    wrapperID: "slideShowImages", // El ID del elemento <div> que contiene todas los elementos <img> que se mostraran en el slideShow.
    buttonID: "slideShowButton", //  ID del elemento <button> que cambia la muestra del slideshow.
    buttonStartText: "Start Slides", // Texto usado en el boton del slideshow.
    buttonStopText: "Stop Slides", // Texto usado en el boton del slideshow.    
    wrapperObject: null, // Coniene una referencia al elemento <div> que contiele todos los elementos <img> que se mostraran.
    buttonObject: null, //i esta presente, contiene una referencia al elemento <button> que enciende y apaga el slideshow. La primicia inicial es que no existe tal botón (por ende el valor false).
    slideImages: [], //  Contendrá todos los objetos de imagen para el slide.
    slideShowID: null, // Un valor ID de setInterval() usado para detener el slide show.
    slideShowRunning: true, // Usado para grabar cuando el slideshow esta corriendo y cuando no.El slideshow esta corriendo por default.    
    slideIndex: 0 // El index de la imagen actual.
  };
  
  /* MAIN *************************************************************************************************/
  
  initializeGlobals();  
  
  if ( insufficientSlideShowMarkup() ) {
    return; // Insufficient slide show markup - exit now.
  }
 
   // Assert: hay al menos un objeto de imagen.
 
  if (globals.slideImages.length === 1) {
    return; // El solo de imagen en el slide ya esta siendo  - exit now.
  }
  
  // Assert: hay al menos dos imagenes en el slide.
  
  initializeSlideShowMarkup();
  
  globals.wrapperObject.addEventListener('click', toggleSlideShow, false); //  Si el usuario hace click en alguna de las imagenes del slideshow, enciende o apaga la transición del slideshow.
  
  if (globals.buttonObject) {
    globals.buttonObject.addEventListener('click', toggleSlideShow, false); //  La invocacion es usada para cambiar el estado de transicion del slideshow.
  } 
  
  startSlideShow();
  
  /* FUNCTIONS ********************************************************************************************/
  
  function initializeGlobals() {   
    globals.wrapperObject = (document.getElementById(globals.wrapperID) ? document.getElementById(globals.wrapperID) : null);
    globals.buttonObject = (document.getElementById(globals.buttonID) ? document.getElementById(globals.buttonID) : null);   
    
    if (globals.wrapperObject) {
      globals.slideImages = (globals.wrapperObject.querySelectorAll('img') ? globals.wrapperObject.querySelectorAll('img') : []);
    }
  } // initializeGlobals
  
  // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

  function insufficientSlideShowMarkup() {
    if (!globals.wrapperObject) { // No hay ningun contenedor cuyo ID sea globals.wrapperID - fatal error.
      if (globals.buttonObject) {
        globals.buttonObject.style.display = "none"; // Esconder los botones innecesarios cuando está presente.
      }
      return true;
    }

    if (!globals.slideImages.length) { // Debe haber al menos un elemento <img> para el slideshow - fatal error.
      if (globals.wrapperObject) {
        globals.wrapperObject.style.display = "none"; //  Esconder el contenedor <div> innecesario.
      }
    
      if (globals.buttonObject) {
        globals.buttonObject.style.display = "none"; //  Esconder el boton para slideshow innecesario.
      }
    
      return true;
    }
    
    return false; // El resultado esperado por esta libreria parece estar presente.
  } // insufficientSlideShowMarkup
  
  // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

  function initializeSlideShowMarkup() {  
    var slideWidthMax = maxSlideWidth(); // Regresa un valor que esta siempre expresado en pixeles.
    var slideHeightMax = maxSlideHeight(); // Regresa un valor que esta siempre expresado en pixeles.
    
    globals.wrapperObject.style.position = "relative";
    globals.wrapperObject.style.overflow = "hidden"; // Esto es solo por cuestiones de seguridad.
    globals.wrapperObject.style.width = slideWidthMax + "px";
    globals.wrapperObject.style.height = slideHeightMax + "px";
    
    var slideCount = globals.slideImages.length;
    for (var i = 0; i < slideCount; i++) { 
      globals.slideImages[i].style.opacity = 0;
      globals.slideImages[i].style.position = "absolute";
      globals.slideImages[i].style.top = (slideHeightMax - globals.slideImages[i].getBoundingClientRect().height) / 2 + "px";   
      globals.slideImages[i].style.left = (slideWidthMax - globals.slideImages[i].getBoundingClientRect().width) / 2 + "px";               
    }
    
    globals.slideImages[0].style.opacity = 1; // Hacer visible el primer slide.
        
    if (globals.buttonObject) {
      globals.buttonObject.textContent = globals.buttonStopText;
    }
  } // initializeSlideShowMarkup
  
  // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    
  function maxSlideWidth() {
    var maxWidth = 0;
    var maxSlideIndex = 0;
    var slideCount = globals.slideImages.length;
    
    for (var i = 0; i < slideCount; i++) {
      if (globals.slideImages[i].width > maxWidth) {
        maxWidth = globals.slideImages[i].width; // La anchura del slide más ancho hasta el momento.
        maxSlideIndex = i; // El slide más ancho hasta el momento.
      }
    }

    return globals.slideImages[maxSlideIndex].getBoundingClientRect().width; // Account for the image's border, padding, and margin values. Note that getBoundingClientRect() is always in units of pixels.
  } // maxSlideWidth
  
  // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    
  function maxSlideHeight() {
    var maxHeight = 0;
    var maxSlideIndex = 0;    
    var slideCount = globals.slideImages.length;
    
    for (var i = 0; i < slideCount; i++) {
      if (globals.slideImages[i].height > maxHeight) {
        maxHeight = globals.slideImages[i].height; // La altura de la imagen más alta hasta el momento.
        maxSlideIndex = i; // La altura de la imagen más alta hasta el momento.
      }
    }
    
    return globals.slideImages[maxSlideIndex].getBoundingClientRect().height; // Account for the image's border, padding, and margin values. Note that getBoundingClientRect() is always in units of pixels.
  } // maxSlideHeight

  // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

  function startSlideShow() {
    globals.slideShowID = setInterval(transitionSlides, globals.slideDelay);                
  } // startSlideShow

  // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
  
  function haltSlideShow() {
    clearInterval(globals.slideShowID);   
  } // haltSlideShow

  // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
  
  function toggleSlideShow() {
    if (globals.slideShowRunning) {
      haltSlideShow();
      if (globals.buttonObject) { 
        globals.buttonObject.textContent = globals.buttonStartText; 
      }
    }
    else {
      startSlideShow();
      if (globals.buttonObject) { 
        globals.buttonObject.textContent = globals.buttonStopText; 
      }            
    }
    globals.slideShowRunning = !(globals.slideShowRunning);
  } // toggleSlideShow
  
  // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

  function transitionSlides() {
    var currentSlide = globals.slideImages[globals.slideIndex];
    
    ++(globals.slideIndex);
    if (globals.slideIndex >= globals.slideImages.length) {
      globals.slideIndex = 0;
    }
    
    var nextSlide = globals.slideImages[globals.slideIndex];
    
    var currentSlideOpacity = 1; // Desvanecer el slide actual.
    var nextSlideOpacity = 0; // Devanecer a entrada el proximo slide.
    var opacityLevelIncrement = 1 / globals.fadeDelay;
    var fadeActiveSlidesID = setInterval(fadeActiveSlides, globals.fadeDelay);
    
    function fadeActiveSlides() {
      currentSlideOpacity -= opacityLevelIncrement;
      nextSlideOpacity += opacityLevelIncrement;
      
      // console.log(currentSlideOpacity + nextSlideOpacity); // This should always be very close to 1.
      
      if (currentSlideOpacity >= 0 && nextSlideOpacity <= 1) {
        currentSlide.style.opacity = currentSlideOpacity;
        nextSlide.style.opacity = nextSlideOpacity; 
      }
      else {
        currentSlide.style.opacity = 0;
        nextSlide.style.opacity = 1; 
        clearInterval(fadeActiveSlidesID);
      }        
    } // fadeActiveSlides
  } // transitionSlides
  
} // slideShow            