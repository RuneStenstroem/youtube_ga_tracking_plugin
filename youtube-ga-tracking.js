

//Start Youtube API
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var youtubeReady = false;

//Variable for the dynamically created youtube players
var players= new Array();
var isPlaying = false;
function onYouTubeIframeAPIReady(){
	youtubeReady = true;
	//The id of the iframe and is the same as the videoId	
	jQuery(".youtube-video").each(function(i, obj) {
   	players[obj.id] = new YT.Player(obj.id, {         
      videoId: obj.id,
      playerVars: {
        controls: 2,
        rel:0,
        autohide:1,
        showinfo: 1 ,
        modestbranding: 0,
        wmode: "transparent",
        html5: 1
     	},   
      events: {
        'onStateChange': onPlayerStateChange
      }
    });
  });
  youtubeReady = true;
}

function onPlayerStateChange(event) {
  switch(event.data){
    case 0:
      ga('send', 'event', 'video', 'ended', event.target.getVideoData().title.toString() + " -- Website titel: " + document.title); 
      break;
    case 1:
      ga('send', 'event', 'video', 'played', event.target.getVideoData().title.toString() + " -- Website titel: " + document.title); 
      break;
    case 2:
      //get video duration
      var c = event.target.getCurrentTime()/event.target.getDuration()*100;
      ga('send', 'event', 'video', 'paused', event.target.getVideoData().title.toString() + " -- Website titel: " + document.title, c.toFixed()); 
      break;
    default:
      break;
    }
};
