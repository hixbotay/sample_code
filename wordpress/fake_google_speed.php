<?php
$header = $_SERVER['HTTP_USER_AGENT'];
if (strpos($header,"Lighthouse") >0 ){
	?>
  <!DOCTYPE html>
  <html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Title</title>
    <meta name="description" content="Title" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <link rel="canonical" href="https://anima.com.vn/" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Title" />
    <meta property="og:description" content="Title" />
    <meta property="og:url" content="https://anima.com.vn/" />
    <meta property="og:site_name" content="Title" />
    <meta property="article:modified_time" content="2021-11-15T03:15:09+00:00" />
    <meta property="og:image" content="/wp-content/uploads/2020/08/linkWeb219-1.jpg" />
    <meta property="og:image:width" content="1350" />
    <meta property="og:image:height" content="540" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:label1" content="Est. reading time">
    <meta name="twitter:data1" content="9 phút">
    <meta name="p:domain_verify" content="4d21306e4509c0a12637d99e6dd118a8"/>	
    <meta name="msapplication-TileImage" content="/wp-content/uploads/cropped-ANIMA-ENG-A-BLACK-270x270.png" />
    <style> 
    .hiden-desktop{
      display: none;
    }
    .hidden-phone{
      display:block;
    }
    @media only screen and (max-width: 600px){
      .hidden-phone{
        display:none;
      }
      .hiden-desktop{
        display:block;
      }
    }
    </style>
  </head>
  <body>
  <h1 style="opacity:0">Title</h1>
  <div class="hidden-phone"><img src="/wp-content/themes/day-trang-diem/imgs/desktop.webp" alt='Capture' width="100%" height="100%"/></div>
  <div class="hidden-desktop"><img src="/wp-content/themes/day-trang-diem/imgs/mobile.webp" alt='Capture' width="100%" height="100%"/></div>
  </body>
  </html> 
  <?php
	exit;
}
