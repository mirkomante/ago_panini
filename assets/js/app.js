//const player = require("@vimeo/player");

const   isHome        = document.body.classList.contains('home'),
        menuIcon      = document.getElementById('menu-toggle'),
        menuItems     = document.querySelectorAll('block'),
        // elSite        = document.querySelector('#site'),
        filters       = document.querySelectorAll('.filter'),
        projects      = document.querySelectorAll('.project'),
        modalWrap     = document.getElementById('modal-wrap'),
        modal         = document.querySelector('.modal-scrim'),
        getParams     = new Proxy(new URLSearchParams(window.location.search), {
          get: (searchParams, prop) => searchParams.get(prop),
        });
// const isHidden = () => projects.classList.contains('remove');
var     openMenu      = false,
        //activeFilter  = '',
        activeFilter  = getParams.show_reel!=null ? getParams.show_reel : '',
        vimeoPlayer   = false,
        vimeoLoop     = false,
        videoiFrames  = Array(),
        videoCarousel = Array(),
        widthScreen   = Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
        videoPlayer,
        videoWidth,
        videoHeight,
        video_id,
        ytVideo;


console.log('start');

//window.history.pushState({}, document.title, window.location.pathname);

if(activeFilter){
  filterElements(activeFilter);
}

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

      document.body.removeAttribute('style','overflow: hidden;');

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

      document.body.setAttribute('style','overflow: hidden;');

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
    filterElements(this.getAttribute('data-filter'));
    
    let new_url = new URLSearchParams(window.location.search);
        new_url.set('show_reel',this.getAttribute('data-filter'));
        history.pushState(null, null, "?"+new_url.toString());

    
  });
});

function filterElements(active){

  let selectedFilter  = active,
      itemsToHide     = document.querySelectorAll(`.projects .project:not([data-filter='${selectedFilter}'])`),
      itemsToShow     = document.querySelectorAll(`.projects [data-filter*='${selectedFilter}']`);
      
  // if(activeFilter == selectedFilter) {
  //   activeFilter = '';
  //   itemsToHide = [];
  //   itemsToShow = document.querySelectorAll('.projects [data-filter]');
  // }else{
  //   activeFilter = selectedFilter;
  // }

  // if (selectedFilter == 'all') {
  //   itemsToHide = [];
  //   itemsToShow = document.querySelectorAll('.projects [data-filter]');
  // }

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

}

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
    // if(tag){

    //   tag.remove();
    //   let scr  = document.getElementById('www-widgetapi-script');
    //       //scr.remove();

    // }
  });

  modal.addEventListener('transitionend', function() {

    if(!modal.classList.contains('modal-scrim-show')){

      modalWrap.classList.remove('z-50');
      modalWrap.classList.add('-z-10');
      document.body.removeAttribute('style','overflow: hidden;')

    }
  });

}

function showModal(id) {

  document.body.setAttribute('style','overflow: hidden;');

  modalWrap.classList.remove('-z-10');
  modalWrap.classList.add('z-50');

  modal.classList.toggle('modal-scrim-show');
  modal.querySelector('.modal').classList.toggle('modal-show');

  vimeoPlayer     = true;
  video_id        = id;

  let isVimeo     = /^\d+$/.test(video_id),
      video_url,
      scaleVideo  = .65;

  if(widthScreen<641){
    scaleVideo  = .85;
  }

  videoWidth  = Math.min(1110, widthScreen*scaleVideo);
  videoHeight = videoWidth*9/16;

  if (isVimeo) {
    video_url   = 'https://vimeo.com/'+video_id;
    let video_options = {
      url: video_url,
      width: videoWidth
    };
    videoPlayer = new Vimeo.Player('video_player', video_options);

  }else if(ytVideo){

    videoPlayer = new YT.Player('video_player', {
      height: videoHeight,
      width: videoWidth,
      videoId: video_id,
      autoplay: 0,
      modestbranding: 1,
      playsinline:1
    });
  }else{
    let tag             = document.createElement('script');
        tag.src         = "https://www.youtube.com/iframe_api";
    let firstScriptTag  = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    ytVideo  = true;
  }
}

function onYouTubeIframeAPIReady() {
  videoPlayer = new YT.Player('video_player', {
    height: videoHeight,
    width: videoWidth,
    videoId: video_id,
    autoplay: 0,
    modestbranding: 0,
    playsinline:1,
    rel:0,
    showinfo:0
  });
}

function Marquee(selector, speed) {
  const parentSelector  = document.querySelector(selector);
  const clone           = parentSelector.innerHTML;
  const firstElement    = parentSelector.children[0];
  let secondElement     = firstElement.children[0].offsetWidth;
  let i = 0;

  firstElement.addEventListener('click',function(){
    console.log('click');
    console.log(secondElement);
    console.log(secondElement.offsetWidth);
  })
  parentSelector.insertAdjacentHTML('beforeend', clone);
  parentSelector.insertAdjacentHTML('beforeend', clone);


  firstElement.style.marginLeft = Math.abs((widthScreen-secondElement)*.5)+'px';

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
