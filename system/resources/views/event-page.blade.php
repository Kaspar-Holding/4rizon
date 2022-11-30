<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Tue Nov 08 2022 19:02:03 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="63644523acc17932e30a8bda" data-wf-site="636417981c03ca1b09a84b12">
<head>
  <meta charset="utf-8">
  <title>Event-page</title>
  <meta content="Event-page" property="og:title">
  <meta content="Event-page" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="new/css/normalize.css" rel="stylesheet" type="text/css">
  <link href="new/css/webflow.css" rel="stylesheet" type="text/css">
  <link href="new/css/4rizon.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Mulish:300,regular,500,600,700,800,900"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon-32x32.png" rel="shortcut icon" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
  <style>
    .has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}
#date {
  width: 150px;
  outline: none;
  border: 1px solid #aaa;
  padding: 6px 28px;
  color: #aaa;
}

.date-container {
  position: relative;
  float: left;
  .date-text {
    position: absolute;
    top: 6px;
    left: 12px;
    color: #aaa;
  }
  
  .date-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    /* pointer-events: none; */
    cursor: pointer;
    color: #aaa;
  }
}
  </style>
</head>
<body class="body-2">
  <div class="main-section wf-section">
    <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar-2 w-nav">
      <div class="w-container">
        <a href="#" class="w-nav-brand"><img src="images/LOGO-01-1.svg" loading="lazy" alt="" class="image-6"></a>
         <nav role="navigation" class="nav-menu-2 w-nav-menu">
          <a href="{{ route('homepage') }}" aria-current="page" class="nav-link-3 w-nav-link">Home</a>
          <a href="{{ route('event-page') }}" class="nav-link-3 w-nav-link w--current">Events</a>
          <a href="{{ route('gallery1') }}" class="nav-link-2 w-nav-link">Gallery</a>
          <a href="{{ route('about-us') }}" class="nav-link-2 w-nav-link">About Us</a>
          <a href="{{ route('contact-us') }}" class="nav-link-3 w-nav-link">Contact</a>
          <a href="{{ route('book-event') }}" class="nav-link-3 button w-nav-link">Book Event</a>
        </nav>
        <div class="menu-button-2 w-nav-button">
          <div class="w-icon-nav-menu"></div>
        </div>
      </div>
    </div>
    <div class="container-5 w-container">
      <div>
        <h1 class="heading-15">Upcoming Events</h1>
      </div>
    </div>
  </div>
  <div class="events wf-section">
    <div class="container-6 w-container">
      <div>
        <div class="row">
          <div class="col-lg-6">
              <div class="form-group has-search" style="display: flex;
    flex-direction: row-reverse;">
             
              <input type="text" class="form-control" placeholder="Search"  style="padding-left: 0.67em!important">
               <span class="fa fa-search form-control-feedback"></span>
              
            </div>
          </div>
          <div class="col-lg-6">
           
        <div class="ui calendar" id="rangestart">
          <div class="ui input left icon" style="width:100%">
            
            <input type="text" placeholder="Select Date" style="padding-left: 0.67em!important">
            <i class="calendar icon" style="right: 1px;
    left: auto;"></i>
          </div>
        
      </div>
          </div>
        </div>
        <div class="w-layout-grid grid-14">
          <div id="w-node-_9a8c6244-0816-b407-bda3-415b577fda87-e30a8bda" class="div-block-24"></div>
          <div id="w-node-_44b47dcc-fa36-a317-2391-ac345425520d-e30a8bda" class="div-block-25"></div>
        </div>
        <div class="div-block-26">
          <div class="w-layout-grid grid-15">
            @foreach ($event_list as $event)
                <div id="w-node-_63f0f9a8-7dc0-ac4c-1892-a756653ae65e-e30a8bda">
                  <div class="w-layout-grid grid-16" style="margin-bottom:40px;">
                    <div id="w-node-_346e9f91-eb85-6676-fc75-91adb38748b7-e30a8bda"><img src="image/{{$event['event_image']}}" loading="lazy"  sizes="(max-width: 479px) 96vw, (max-width: 767px) 97vw, 604.9999389648438px" alt="" style="width:500px;height:500px;"></div>
                    <div id="w-node-abe0d26a-7e21-ffd5-2fad-088e6ed55d82-e30a8bda">
                      <h3 class="heading-16">{{$event['event_name']}}</h3>
                      <p class="paragraph-7">{{ date('l d M Y', strtotime($event['event_date']))}}</p>
                      <div class="div-block-27">
                        <a href="#" class="link">Book Event</a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-section wf-section">
    <div class="container-4 w-container">
      <div class="div-block-17">
        <div class="w-layout-grid grid-10">
          <div id="w-node-_02d47209-7f69-f6ac-efb3-10ae17829d7e-b5a84b13" class="div-block-20">
            <p class="paragraph-5">A totally new nightlife immersive experience with the best DJs and Specialists. Now is the ideal time to take your entertainment to a higher level.</p>
          </div>
          <div id="w-node-ea50531f-4263-c568-cc49-6f7a1024e3f9-b5a84b13">
            <h1 class="heading-10">Contact Us</h1>
            <div class="w-layout-grid grid-11">
              <div id="w-node-d79204e9-6a71-909b-8b63-070778ed3dc7-b5a84b13"><img src="images/icon-03.webp" loading="lazy" width="696" id="w-node-ef6687b5-37ed-2755-78d5-5bfb4e29f9eb-b5a84b13" sizes="(max-width: 479px) 57vw, (max-width: 767px) 91vw, 695.9942626953125px" srcset="images/icon-03-p-500.webp 500w, images/icon-03-p-800.webp 800w, images/icon-03.webp 1392w" alt="" class="image-2"></div>
              <div id="w-node-_282152f2-4872-b5c6-4a38-e615f5c1a003-b5a84b13">
                <h6 class="heading-11">Fourways, Johannesburg</h6>
              </div>
              <div id="w-node-_40c5f859-5786-53a1-39be-b678ddbacd56-b5a84b13"><img src="images/icon-04.webp" loading="lazy" id="w-node-_7bab0343-76e0-d7f0-919b-6c4175c72bb5-b5a84b13" srcset="images/icon-04-p-500.webp 500w, images/icon-04-p-800.webp 800w, images/icon-04.webp 1392w" sizes="(max-width: 479px) 48vw, (max-width: 767px) 95vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt="" class="image-3"></div>
              <div id="w-node-_1533551e-2849-f0bf-9479-2e925e545d29-b5a84b13">
                <h6 class="heading-12">+27 66 230 4022</h6>
              </div>
              <div id="w-node-_47e5aff7-874e-52c9-045a-84fe8c68c385-b5a84b13"><img src="images/icon-05.webp" loading="lazy" id="w-node-_8ba039fa-7113-8084-3abd-ea1cc74bd5f1-b5a84b13" srcset="images/icon-05-p-500.webp 500w, images/icon-05-p-800.webp 800w, images/icon-05.webp 1392w" sizes="(max-width: 479px) 48vw, (max-width: 767px) 95vw, (max-width: 991px) 727.9923706054688px, 939.9999389648438px" alt="" class="image-4"></div>
              <div id="w-node-b56d7c11-3533-446a-9f2c-a4eaf3e133d9-b5a84b13" class="div-block-29">
                <h6 class="heading-13">contact@4rizon.com</h6>
              </div>
            </div>
          </div>
          <div id="w-node-_7c2092a7-786e-3fce-4a55-b867e09686d2-b5a84b13">
            <h1 class="heading-10">Working Hours</h1>
            <div class="div-block-19">
              <h6 class="heading-11">Will be opening Soon</h6>
            </div>
            <div class="div-block-18">
              <h6 class="heading-12">Will be opening Soon</h6>
            </div>
          </div>
          <div id="w-node-_2672fe8e-b26c-a35f-71f8-2191f43ed520-b5a84b13">
            <div class="w-layout-grid grid-26">
              <div id="w-node-ae45a09d-c61f-c5ed-b0e0-ba62358da8b6-b5a84b13">
                <h2 class="heading-19 heading-20">Download Our App</h2>
                <p class="paragraph-10">Download the 4rizon Application on the App store and the Playstore for some exciting new features and earn some perks!</p>
                <div class="div-block-41">
                  <a href="#" class="w-inline-block"><img src="images/Group-6.png" loading="lazy" alt=""></a>
                  <div class="div-block-40">
                    <a href="#" class="w-inline-block"><img src="images/Group-7.png" loading="lazy" alt=""></a>
                  </div>
                </div>
              </div>
              <div id="w-node-_8831a1ae-69b4-4c66-42c9-16dfe114eb08-b5a84b13"><img src="images/Download-App-02-1.png" loading="lazy" alt=""></div>
            </div>
          </div>
        </div>
        <div id="w-node-fc1b37b1-f0df-ac54-e1ec-7dec7fbe4d1a-b5a84b13">
          <h3 class="heading-14">Copyright 4rizon Bar, lounge &amp; Musical Entertainment. 2022</h3>
        </div>
      </div>
    </div>
  </div>
  <script>
    $('#example1').calendar();
$('#example2').calendar({
  type: 'date'
});
$('#example3').calendar({
  type: 'time'
});
$('#rangestart').calendar({
  type: 'date',
  endCalendar: $('#rangeend')
});
$('#rangeend').calendar({
  type: 'date',
  startCalendar: $('#rangestart')
});
$('#example4').calendar({
  startMode: 'year'
});
$('#example5').calendar();
$('#example6').calendar({
  ampm: false,
  type: 'time'
});
$('#example7').calendar({
  type: 'month'
});
$('#example8').calendar({
  type: 'year'
});
$('#example9').calendar();
$('#example10').calendar({
  on: 'hover'
});
var today = new Date();
$('#example11').calendar({
  minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 5),
  maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
});
$('#example12').calendar({
  monthFirst: false
});
$('#example13').calendar({
  monthFirst: false,
  formatter: {
    date: function (date, settings) {
      if (!date) return '';
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      return day + '/' + month + '/' + year;
    }
  }
});
$('#example14').calendar({
  inline: true
});
$('#example15').calendar();
  </script>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=636417981c03ca1b09a84b12" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="new/js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>