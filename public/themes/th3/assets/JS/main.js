

//********************* */ navbar section ******************

// Wait for the DOM (Document Object Model) to be fully loaded
document.addEventListener('DOMContentLoaded', function(event) {

  // Hamburger menu
  var navbarToggler = document.querySelectorAll('.navbar-toggler')[0];
  navbarToggler.addEventListener('click', function(e) {
    e.target.children[0].classList.toggle('active');
  });

});



// / news scroller 

// jQuery.fn.liScroll = function(settings) {
// 	settings = jQuery.extend({
// 		travelocity: 0.03
// 		}, settings);		
// 		return this.each(function(){
// 				var $strip = jQuery(this);
// 				$strip.addClass("newsticker")
// 				var stripHeight = 1;
// 				$strip.find("li").each(function(i){
// 					stripHeight += jQuery(this, i).outerHeight(false); // thanks to Michael Haszprunar and Fabien Volpi
// 				});
// 				var $mask = $strip.wrap("<div class='mask'></div>");
// 				var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");								
// 				var containerHeight = $strip.parent().parent().height();	//a.k.a. 'mask' width 	
// 				$strip.height(stripHeight);			
// 				var totalTravel = stripHeight;
// 				var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		
// 				function scrollnews(spazio, tempo){
// 				$strip.animate({top: '-='+ spazio}, tempo, "linear", function(){$strip.css("top", containerHeight); scrollnews(totalTravel, defTiming);});
// 				}
// 				scrollnews(totalTravel, defTiming);				
// 				$strip.hover(function(){
// 				  jQuery(this).stop();
// 				},
// 				function(){
// 				  var offset = jQuery(this).offset();
// 				  var residualSpace = offset.top + stripHeight;
// 				  var residualTime = residualSpace/settings.travelocity;
// 				  scrollnews(residualSpace, residualTime);
// 				});			
// 		});	
// };
// $(function(){
//   $("ul#ticker01").liScroll();
// });




// <!-- ----------------------font size script Start-------------------------- -->


$(document).ready(function () {
  var maxFontSizeChange = 3; // Set the maximum font size change allowed

  $('#fontincrease').click(function () {
      modifyFontSize('increase');
  });
  $('#fontdecrease').click(function () {
      modifyFontSize('decrease');
  });
  $('#fontreset').click(function () {
      modifyFontSize('reset');
  });

  function modifyFontSize(flag) {
      var divElement = $('body');
      var currentFontSize = parseInt(divElement.css('font-size'));

      if (flag == 'increase') {
          currentFontSize += 3;
          if (currentFontSize > 22) { // Limit to a maximum of 24px
              currentFontSize = 22;
          }
      } else if (flag == 'decrease') {
          currentFontSize -= 3;
          if (currentFontSize < 11) { // Limit to a minimum of 12px
              currentFontSize = 11;
          }
      } else {
          currentFontSize = 16; // Reset to the default font size
      }

      divElement.css('font-size', currentFontSize + 'px');
  }
});





const sliderContainer = document.querySelector('.slider-container');
  const sliderWrapper = document.querySelector('.slider-wrapper');
  const sliderItems = document.querySelectorAll('.slider-item');
  const prevButton = document.querySelector('.nav-button.prev');
  const nextButton = document.querySelector('.nav-button.next');
  
  let currentIndex = 0;
  const itemsPerView = 3;
  const totalItems = sliderItems.length;

  // Clone first and last items to create an infinite loop effect
  const firstItem = sliderWrapper.firstElementChild.cloneNode(true);
  const lastItem = sliderWrapper.lastElementChild.cloneNode(true);
  sliderWrapper.appendChild(firstItem);
  sliderWrapper.insertBefore(lastItem, sliderWrapper.firstElementChild);

  // Update the slider position
  function updateSliderPosition() {
    const translateX = -((currentIndex + 1) * (100 / itemsPerView));
    sliderWrapper.style.transform = `translateX(${translateX}%)`;
  }

  function slideNext() {
    if (currentIndex >= totalItems) {
      currentIndex = 0;
      sliderWrapper.style.transition = 'none';
      updateSliderPosition();
      setTimeout(() => {
        sliderWrapper.style.transition = 'transform 0.5s ease-in-out';
        slideNext();
      }, 50);
    } else {
      currentIndex++;
      updateSliderPosition();
    }
  }

  function slidePrev() {
    if (currentIndex <= -1) {
      currentIndex = totalItems - 1;
      sliderWrapper.style.transition = 'none';
      updateSliderPosition();
      setTimeout(() => {
        sliderWrapper.style.transition = 'transform 0.5s ease-in-out';
        slidePrev();
      }, 50);
    } else {
      currentIndex--;
      updateSliderPosition();
    }
  }

  nextButton.addEventListener('click', slideNext);
  prevButton.addEventListener('click', slidePrev);

  // Auto slide
  setInterval(slideNext, 6000);

  // Initialize position
  updateSliderPosition();









//
// Bootstrap Carousel Effect Ken Burns
// =============================================================================

const html = document.querySelector('html');
html.setAttribute('data-bs-theme', 'dark');

function ready (fn) {
  if (document.readyState != 'loading') {
    fn()
  } else {
    document.addEventListener('DOMContentLoaded', fn)
  }
}

ready(() => {
  // --- Function to add and remove CSS animation classes
  function doAnimations(elems) {
    const animEndEv = 'animationend';

    elems.forEach((elem) => {
      elem.classList.add('animate__animated', 'animate__flipInX');
      elem.addEventListener(animEndEv, () => {
        elem.classList.remove('animate__animated', 'animate__flipInX');
      });
    });
  }

  // --- Variables on page load
  const carouselKenBurns = document.querySelector('#carouselKenBurns');
  const firstAnimatingElems = Array.from(
    carouselKenBurns.querySelector('.carousel-item:first-child')
      .querySelectorAll("[data-animation^='animated']")
  );

  // --- Animate captions in the first slide on page load
  doAnimations(firstAnimatingElems);

  // --- Other slides to be animated on carousel slide event
  carouselKenBurns.addEventListener('slid.bs.carousel', (e) => {
    const animatingElems = Array.from(e.relatedTarget.querySelectorAll("[data-animation^='animated']"));
    doAnimations(animatingElems);
  });
})
