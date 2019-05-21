   <!DOCTYPE html>
   <html>
   <head>
     <meta charset="UTF-8">
     <title>Beyond Technical Test</title>
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

     <section>
              <div class="container">
                <div class="row">

     <?php

	$data = array(
      'part' => 'snippet,contentDetails,status',
      'maxResults' => '10',
      'playlistId' => 'PLSi28iDfECJPJYFA4wjlF5KUucFvc0qbQ',
	    'key' 			=> 'AIzaSyCuv_16onZRx3qHDStC-FUp__A6si-fStw',
	);

	$query = http_build_query($data);

	$url = 'https://www.googleapis.com/youtube/v3/playlistItems?' . $query;

	$json = file_get_contents($url);
	$obj = json_decode($json);


	// echo '<pre>';
	// var_dump($obj);
	// echo '</pre>';


	if( count($obj->items) === 0 ) {
		echo 'No results';
	} else {

    $_index = 0;

		foreach($obj->items as $video) {

      if($_index === 3) {
        $_index = 0;

        echo "</div>
        <div class='row'>";

      }

      $_index++;

      $originalDate = $video->snippet->publishedAt;
      $newDate = date("M d, Y", strtotime($originalDate));


			echo '
      <a class="four columns" href="video.php?id='. $video->id .'">
			<div class="yt-thumb">
				<img class="thumb" src="'.$video->snippet->thumbnails->medium->url.'"/>
        <div class="bannerInfo">
          <p class="videoTitle">'.$video->snippet->title.'</p>
          <img src="img/play_button.svg" />
        </div>
			</div>
				<div class="itemContent">

          <p class="publishDate">Published on '.$newDate.'</p>
					<small class="description">';
          if ($video->snippet->description !== "") {
            echo substr($video->snippet->description, 0, 200)."...";
          } else {
            echo "<i>No description</i>";
          }
          echo '
          </small>
				</div>
			</a>';

		}

	}
?>

         </div>
     </div>
   </section>
   </body>
   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

   </html>
