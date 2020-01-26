         <?php
       parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id=WwVZBfMlNPA'), $video_data);
       $streams = $video_data['url_encoded_fmt_stream_map'];
       $thumburl = $video_data['iurlmq'];
       $streams = explode(',',$streams);
       $counter = 1;
     ?>
      <img src="<?php echo $thumburl; ?>" />
      <br/>
      
      <?php
        foreach ($streams as $streamdata) {
      printf("Stream %d:<br/>----------------<br/><br/>", $counter);
      
      parse_str($streamdata,$streamdata);
      
      foreach ($streamdata as $key => $value) {
        if ($key == "url") {
          $value = urldecode($value);
          ?>
          <strong><?php echo $key;?>:</strong> <a href='<?php echo $value; ?>' download='downloadfilename'>Download Video</a><br/>
      <?php echo "<br/><br/>";echo "<br/><br/>";
          } else {
          printf("<strong>%s:</strong> %s<br/>", $key, $value);
        }
      }
      $counter = $counter+1;
      printf("<br/><br/>");
    }
	?>
	
	<form action="index.php" method="get">
    URL: <input type="text" name="yturl">
    <input type="submit">
    </form>
    <?php
    if (isset($_GET["yturl"])) {
    $url = $_GET["yturl"];
    $regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
    $match;
    if(preg_match($regex_pattern, $url, $match)){
        
    parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );  
    $idfromurl = $my_array_of_vars['v'];
    echo "<br/>";
    // Download Videos from Youtube in PHP
    // By: Sheharyar Naseer
    $id = $idfromurl; // just in case
    parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id='.$id), $video_data);
    //parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id=Fw4jHDPaagg&el=vevo&el=embedded'), $video_data);
    $streams = $video_data['url_encoded_fmt_stream_map'];
    $thumburl = $video_data['iurlmq'];
    $streams = explode(',',$streams);
    $counter = 1;
    ?>
      
      
      <img src="<?php echo $thumburl; ?>" />
      <br/>
      
      <?php
        foreach ($streams as $streamdata) {
      printf("Stream %d:<br/>----------------<br/><br/>", $counter);
      
      parse_str($streamdata,$streamdata);
      
      foreach ($streamdata as $key => $value) {
        if ($key == "url") {
          $value = urldecode($value);
          ?>
          <strong><?php echo $key;?>:</strong> <a href='<?php echo $value; ?>' download='downloadfilename'>Download Video</a><br/>
          
          <?php echo "<br/><br/>";
        } else {
          printf("<strong>%s:</strong> %s<br/>", $key, $value);
        }
      }
      $counter = $counter+1;
      printf("<br/><br/>");
    }
    }else{
        echo "Sorry, not a youtube Video URL";
    }
    }
    ?>