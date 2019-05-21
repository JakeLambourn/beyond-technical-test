<?php

	/* ================================================== */
    	$error = "false";
		$errorMsg = array();

		$debug = var_export($_GET, true);
		$results = "";
		$query = array();
	/* ================================================== */


	if( isset($_GET['id']) && $_GET['id'] != "" ) {
		$video = $_GET['id'];
	} else {
		$video = 'n-_n2V9hUAA';
	}

  $data = array(
      'key' 			=> 'AIzaSyCuv_16onZRx3qHDStC-FUp__A6si-fStw',
      'id' => $video,
      'part' => 'snippet,contentDetails,status',

      // 'playlistId' => 'PLSi28iDfECJPJYFA4wjlF5KUucFvc0qbQ',

	);


	$query = http_build_query($data);

	$url = 'https://www.googleapis.com/youtube/v3/playlistItems?' . $query;


	$json = file_get_contents($url);
	$obj = json_decode($json);

/*
	echo '<pre>';
	var_dump($obj);
	echo '</pre>';
*/

$video = $obj->items[0];

	$arr = array (
		'success'=>'I am a success',
		'error'		=>$error,
		'errormsg'	=>$errorMsg,
		'debug'		=>$debug,
		'url'		=>$buildurl,
		'json'		=>print_r($obj, true)
	);
	//echo json_encode($arr);


  ?>


  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $video->snippet->title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css" />
    <link rel="stylesheet" href="styles/style.css" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>

    <header class="header">
      <img class="header-img" src="img/header_bg.png" alt="header background" />
      <img class="logo" src="img/MusicPlay_logo.png" alt="logo" />
    </header>

    <?php

 if( count($obj->items) === 0 ) {
   echo 'No results';
 } else {


     $originalDate = $video->snippet->publishedAt;
     $newDate = date("M d, Y", strtotime($originalDate));


     echo '
     <section class="featured container singleVideo">
       <div class="row">
     <div class="eight columns">
       <div class="yt-video">
        <iframe src="https://www.youtube.com/embed/'. $video->snippet->resourceId->videoId .'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>></iframe>
      </div>
      </div>
         <div class="four columns">
             <p class="videoTitle">'.$video->snippet->title.'</p>


         <p class="publishDate">Published on '.$newDate.'</p>
         <p class="description">';
         if ($video->snippet->description !== "") {
           echo $video->snippet->description;
         } else {
           echo "<i>No description</i>";
         }
         echo '
         </p>

         <a class="back" href="/"><img src="img/back_arrow.svg" /> Back to list</a>
       </div>
     </div>';

}
?>

</section>

  </body>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  </html>
