<?php
echo("Đội tuyển Việt Nam vô địch.");
  exec('java -Dfile.encoding=UTF8 -jar vitk-cus.jar "Đội tuyển Việt Nam vô địch."', $output);
  echo($output[0]);
?>