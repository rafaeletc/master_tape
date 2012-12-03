<!DOCTYPE html>
<!--
/**
 * Cassette Tape UI Prototype (09/2012)
 * ALPHA build / experimental state, unsupported; use at own risk
 * Requires CSS3 border-radius + <canvas> support
 * http://www.schillmania.com/projects/soundmanager2/
 */
-->
<html>
<head>
<title>Kingston Radio (MA-R90-style design)</title>
<meta name="description" content="An experimental web audio player UI based on the TDK MA-R90 cassette tape, a classic metal-alloy cassette model from 1982. Includes slight translucency and blurring effects." />
<meta name="keywords" content="javascript sound, html5 audio, css3, cassette tape, tdk, mar, ma-r, mar90, html5 sound, javascript audio, schill, schillmania, soundmanager, soundmanager2" />
<meta name="author" content="Rafael etc" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" media="screen" href="css/cassette-tape-ui.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/cassette-tape-ui-blur.css" />
<noscript>
 <!-- Legal? Probably not - but, works. -->
 <link rel="stylesheet" type="text/css" media="screen" href="css/cassette-tape-ui-blur-nojs.css" />
</noscript>
<link rel="stylesheet" type="text/css" media="screen" href="css/demo.css" />
<script src="script/soundmanager2.js"></script>
<script src="script/cassette-tape-ui.js"></script>
<script src="script/demo.js"></script>
</head>

<body>

<div id="demo-header-wrapper">
 <div id="demo-header">
  <h1>Kingston Radio</h1>
  <p>Altere seu background. <a id="nextBackground" href="#next" title="Change background">&#10029;&nbsp;</a>
 </div>
</div>

<div id="tape-loader">
 <div class="spinner-box">
  <div class="spinner"></div>
 </div>
</div>

<!-- 
/**
 * DIV-tastic! Indeed, tons of elements in this version - but this allows for easy customization.
 * The basic version (no canvas + blur effects) uses more images for skinning and has a few less elements.
 */
-->

<div class="draggable clear ma-r90 cutout tape">
 <div class="blur-image-wrapper">
  <canvas class="blur-image"></canvas>
 </div>
 <div class="transparency-sheet"></div>
 <div class="tape-shell image-mask" data-image-repeat="true" data-mask-url="image/ma-r90-mask.png"></div>
 <div class="tape-gradient image-mask" data-mask-url="image/ma-r90-mask.png"></div>
 <div class="tab-left">
  <div class="notch"></div>
  <div class="ridge"></div>
 </div>
 <div class="tab-right">
  <div class="notch"></div>
  <div class="ridge"></div>
 </div>
 <div class="rail-left"></div>
 <div class="rail-right"></div>
 <div class="rail-middle">
  <div class="rail-middle-outline">
   <div class="tape-pad-holder">
    <div class="tape-pad"></div>
    <div class="tape-pad-line"></div>
   </div>
  </div>
  <div class="screw-bm"></div>
 </div>
 <div class="screw-tl"></div>
 <div class="screw-tr"></div>
 <div class="screw-bl"></div>
 <div class="screw-br"></div>
 <div class="screw-tm"></div>
 <div class="left reel-mask"></div>
 <div class="right reel-mask"></div>
 <canvas class="connecting-tape"></canvas>
 <div class="left reel"></div>
 <div class="left spokes"></div>
 <div class="right reel"></div>
 <div class="right spokes"></div>
 <div class="progress-notches">
  <div class="n1"></div>
  <div class="n2"></div>
  <div class="n3"></div>
  <div class="n4"></div>
  <div class="n5"></div>
  <div class="n6"></div>
  <div class="n7"></div>
  <div class="n8"></div>
  <div class="n9"></div>
 </div>

 <!-- static label version -->
 
 <div class="label">
  <script src="http://code.jquery.com/jquery-min.js"></script>
  <script type="text/javascript">
  function nowplaying(){ 
    $.ajax({
    timeout: 10000,
    url: "example.php", 
    cache: false,
    success: function(html){ 
     $("#nowplaying").html(html); 
    }
   }); 
  }
  nowplaying();
  setInterval( "nowplaying()", 10000 ); 
  </script>
  <div id="nowplaying"></div>
 </div>
 

 <div class="aqua controls">
  <div class="bd">
   <ul>
    <li><a href="#" title="play/pause" class="play">&#9668;</a></li>
    <li><a href="#" title="rewind" class="rew">&#171;</a></li>
    <li><a href="#" title="fast-forward" class="ffwd">&#187;</a></li>
    <li><a href="#" title="stop" class="stop">&#9632;</a></li>
   </ul>
  </div>
 </div>
</div>

<div class="thanks">
  <p>Kingston Radio: Stream #1</p>
</div>

<script>
(function() {
  window.setTimeout(function() {
    // transition hack
    document.getElementById('tape-loader').className = 'visible';
  }, 1);
  // oh, what a hack! (demo only: no high-end unicode characters on WinXP)
  var char = '&infin;';
  if (navigator.userAgent.indexOf('Windows NT 5.1') !== -1) {
    document.getElementById('nextBackground').innerHTML = char + '&nbsp;';
  }
}());
</script>

</body>
</html>