<?php 
  /*
   All Emoncms code is released under the GNU General Public License v3.
   See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Emoncms - open source energy visualisation
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org
  */
function feed_controller()
{

  if (!$_SESSION['valid']) return "Sorry, you must be logged in to see this page";

  require "Models/input_model.php";
  require "Models/feed_model.php";

  $userid = $_SESSION['userid'];

  $apikey_write = get_apikey_write($userid);
  $apikey_read = get_apikey_read($userid);

  if ($_POST["form"] == "newapi_write" || !$apikey_write)
  { 
    $apikey_write = md5(uniqid(rand(), true));
    set_apikey_write($userid, $apikey_write);
  }

  if ($_POST["form"] == "newapi_read" || !$apikey_read)
  { 
    $apikey_read = md5(uniqid(rand(), true));
    set_apikey_read($userid, $apikey_read);
  }

  if ($_POST["form"] == "input")
  { 
    $inputid = intval($_POST["id"]);
    $processlist = get_input_processlist_desc($inputid);
  }

  if ($_POST["form"] == "process")
  { 
    $inputid = intval($_POST["id"]);
    $processType = intval($_POST["sel"]);			// get process type
    $arg = $_POST["arg"];
    if ($processType==2) $arg = floatval($arg); 
    if ($processType==3) $arg = floatval($arg); 
    if ($processType==6) $arg = get_input_id($userid,$arg);
    if ($processType == 1 || $processType == 4 || $processType == 5 || $processType == 7 || $processType == 8 || $processType == 9 || $processType == 10 )
    {
      $id = get_feed_id($userid,$arg);
      if ($id==0)  $id = create_feed($userid,$arg);
      $arg = $id;
    }
    add_input_process($inputid,$processType,$arg);
    $processlist = get_input_processlist_desc($inputid);
  }

  $inputs = get_user_inputs($userid);
  $feeds = get_user_feeds($userid);

  // Render view
  $content = view("feed_view.php",array('apikey_read' => $apikey_read,'apikey_write' => $apikey_write, 'inputs' => $inputs, 'inputsel' => $inputid, 'feeds' => $feeds, 'processlist' => $processlist));

  return $content;
}

?>


