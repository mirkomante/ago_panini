//const player = require("@vimeo/player");

const   isHome        = document.body.classList.contains('home'),
        menuIcon      = document.getElementById('menu-toggle'),
        menuItems     = document.querySelectorAll('block'),
        // elSite        = document.querySelector('#site'),
        filters       = document.querySelectorAll('.filter'),
        projects      = document.querySelectorAll('.project'),
        modalWrap     = document.getElementById('modal-wrap'),
        modal         = document.querySelector('.modal-scrim');
// const isHidden = () => projects.classList.contains('remove');
var     openMenu      = false,
        activeFilter  = '',
        vimeoPlayer   = false,
        vimeoLoop     = false,
        videoiFrames  = Array(),
        videoCarousel = Array();


console.log('start');

if(menuIcon){
  menuIcon.addEventListener('click',()=>{
    
    menuIcon.classList.toggle('open');

    let navWrap   = document.getElementById('nav-wrap'),
        navHalfSx = document.querySelector('.nav-half-sx'),
        navHalfDx = document.querySelector('.nav-half-dx'),
        siteLogo  = document.getElementById('logo');

    if(openMenu){

      openMenu  = false;
      navHalfSx.classList.remove('top-0');
      navHalfDx.classList.remove('top-0');
      navHalfSx.classList.add('top-full');
      navHalfDx.classList.add('-top-full');

      if(isHome){
        siteLogo.classList.remove('text-black');
        siteLogo.classList.add('text-white');
      }
      
    }else{
      
      openMenu  = true;
      navHalfSx.classList.remove('top-full');
      navHalfDx.classList.remove('-top-full');
      navHalfSx.classList.add('top-0');
      navHalfDx.classList.add('top-0');

      if(isHome){
        siteLogo.classList.remove('text-white');
        siteLogo.classList.add('text-black');
      }
      
    }
    
    navHalfSx.addEventListener('transitionstart', function() {
      
      if(openMenu){
        navWrap.classList.remove('-z-10');
        navWrap.classList.add('z-30');
      }
    });

    navHalfSx.addEventListener('transitionend', function() {
      
      if(!openMenu){
        navWrap.classList.remove('z-30');
        navWrap.classList.add('-z-10');
      }
    });
  });
}



filters.forEach(filter => { 

  filter.addEventListener('click', function() {

    let selectedFilter  = filter.getAttribute('data-filter'),
        itemsToHide     = document.querySelectorAll(`.projects .project:not([data-filter='${selectedFilter}'])`),
        itemsToShow     = document.querySelectorAll(`.projects [data-filter*='${selectedFilter}']`);

    if(activeFilter == selectedFilter) {
        activeFilter = '';
        itemsToHide = [];
        itemsToShow = document.querySelectorAll('.projects [data-filter]');
    }else{
        activeFilter = selectedFilter;
    }

    if (selectedFilter == 'all') {
      itemsToHide = [];
      itemsToShow = document.querySelectorAll('.projects [data-filter]');
    }

    itemsToHide.forEach(el => {
      el.classList.add('hide');
      el.classList.remove('show');
      el.classList.remove('p-2');
    });

    itemsToShow.forEach(el => {
      el.classList.remove('hide');
      el.classList.add('show');
      el.classList.add('p-2');
    });

  });
});

projects.forEach(project => {
    
  project.addEventListener("click", function () {
    project.getAttribute('data-video');
    showModal(project.getAttribute('data-video'));
  });

});

if(modal){

  modal.addEventListener('click', () => {

    modal.classList.toggle('modal-scrim-show');
    modal.querySelector('.modal').classList.toggle('modal-show');
    
    if (vimeoPlayer) {
      let elem      = document.getElementById('video_player'),
          parent    = elem.parentNode,
          newElem   = document.createElement('div');
            
      newElem.setAttribute('id', 'video_player');
      parent.removeChild(elem);
      parent.appendChild(newElem);
      vimeoPlayer = false;
    }
  });
    
  modal.addEventListener('transitionend', function() {
    
    if(!modal.classList.contains('modal-scrim-show')){
    
      modalWrap.classList.remove('z-50');
      modalWrap.classList.add('-z-10');
      document.body.removeAttribute('style','overflow: hidden;')
      
    }
  });

}

function showModal(video_id) {

  document.body.setAttribute('style','overflow: hidden;');

  modalWrap.classList.remove('-z-10');
  modalWrap.classList.add('z-50');

  modal.classList.toggle('modal-scrim-show');
  modal.querySelector('.modal').classList.toggle('modal-show');

  vimeoPlayer     = true;
    
  let video_url   = 'https://vimeo.com/'+video_id,
      widthScreen = Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
      video_options = {
        url: video_url,
        width: Math.min(1110, widthScreen*.65)
      };

  let videoPlayer = new Vimeo.Player('video_player', video_options);

}

function Marquee(selector, speed) {
  const parentSelector = document.querySelector(selector);
  const clone = parentSelector.innerHTML;
  const firstElement = parentSelector.children[0];
  let i = 0;

  firstElement.addEventListener('click',function(){
    console.log('click');
  })
  parentSelector.insertAdjacentHTML('beforeend', clone);
  parentSelector.insertAdjacentHTML('beforeend', clone);

  setInterval(function () {
    firstElement.style.marginLeft = `-${i}px`;
    if (i > firstElement.clientWidth) {
      i = 0;
    }
    i = i + speed;
  }, 0);
}

if (isHome) {
  window.addEventListener('load', Marquee('.marquee', 0.2));
  window.addEventListener('load', addVimeoCarousel());
}

function addVimeoCarousel(){

    videoiFrames = document.querySelectorAll('iframe');
    videoiFrames.forEach(element => {

      let vPlayer = new Vimeo.Player(element);
          vPlayer.getDuration().then(function(duration) {
            
            let d = duration - 5;
            
            vPlayer.addCuePoint(d, {customKey: 'prepareNextVideo'});

            vPlayer.on('cuepoint', function(data) {              
              nextVideo(this,data.id);
            });

          });

          videoCarousel.push(vPlayer);
    });

    function nextVideo(vid,id){

      let id_actual,id_next;
      id_actual = videoCarousel.indexOf(vid);
      id_next   = id_actual+1;

      if(id_next==videoCarousel.length){
        id_next=0;
        vimeoLoop=true;
      }

      videoCarousel[id_next].play();

      if(vimeoLoop){
        
        videoiFrames[id_actual].classList.add('opacity-0');
        videoiFrames[id_next].classList.remove('opacity-0');

        vid.pause();
        vid.setCurrentTime(0);

      }else{
        videoCarousel[id_next].on('bufferend', function(){
  
          videoiFrames[id_actual].classList.add('opacity-0');  
          videoiFrames[id_next].classList.remove('opacity-0');
  
          vid.pause();
          vid.setCurrentTime(0);
        });
      }
      
    }

}

