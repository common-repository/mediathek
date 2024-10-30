<?php
/*
Plugin Name: Mediathek
Plugin Script: mediathek.php
Description: Füge Videos aus den Mediatheken in Artikel und Seiten ein!
Version: 2.0
License: GPL
Author: Reloado
Author URI: http://mediathek.einbetten.reloado.com

=== RELEASE NOTES ===
2012-09-28 - v1.0 - first version
2013-08-06 - v1.1 - update
2013-09-04 - v2.0 - stable release
*/

/* 
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Online: http://www.gnu.org/licenses/gpl.txt
*/
?><?php
add_shortcode("mediathek", "badge_handler");

function gb($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}

function badge_handler($au) {
$a = $au[url];
  
if (strlen(strstr($a,'http://www.ardmediathek.de/'))>0) {
$id=gb($a."&",'documentId=','&');
//$ou='<div style="width:512px;height:288px;overflow:hidden;position:relative;"><iframe src="'.$a.'" style="position:absolute;top:-210px;left:-170px;width:1280px;height:1200px;" scrolling="no"></iframe></div>';
$ou='<div style="width:515px;height:344px;overflow:hidden;position:relative;"><iframe src="http://m.ardmediathek.de/?docId='.$id.'" style="position:absolute;top:-43px;left:-2px;width:515px;height:1200px;" scrolling="no"></iframe></div>';
}

if (strlen(strstr($a,'http://www.arte.tv/guide/de/'))>0) {
$id=gb($a,'/de/','/');
$ou='<iframe width="560" height="315" src="http://player.arte.tv/v2/index.php?json_url=http://org-www.arte.tv/papi/tvguide/videos/stream/player/D/'.$id.'_PLUS7-D/ALL/ALL.json&lang=de_DE&config=arte_tvguide&embed=1" frameborder="0" allowfullscreen></iframe>';
}

if (strlen(strstr($a,'http://www.zdf.de/ZDFmediathek/'))>0) {
$id=gb($a,'video/','/');
//$ou='<iframe width="560" height="315" src="http://player.zdf.de/zdf/mediathek/miniplayer/index.html?mediaID='.$id.'" frameborder="0" allowfullscreen></iframe>';
$ou='<div id="embedm'.$id.'" onclick="start'.$id.'()" style="cursor:pointer;width:560px;height:315px;overflow:hidden;"><img style="display: block;width: 32px;height: 32px;position: relative;top: 55%;left: 50%;margin-left: -16px;margin-top: -32px;" src="http://www.heute.de/ZDF/zdfportal/blob/25726642/2/data.png"><img width="560" height="315" src="http://www.zdf.de/ZDFmediathek/contentblob/'.$id.'/timg946x532blob/"></div><script>function start'.$id.'() {document.getElementById("embedm'.$id.'").innerHTML = \'<iframe width="560" height="315" src="http://player.zdf.de/zdf/mediathek/miniplayer/index.html?mediaID='.$id.'" frameborder="0" allowfullscreen></iframe>\';}</script>';
}

if ($ou=='') {
$ou='<a href="http://mediathek.einbetten.reloado.com" target="_blank"><img style="max-width:100%;max-height:100%;" src="http://mediathek.einbetten.reloado.com/teaser.png" border="0"></a>';
}
$ou .= '<!-- Inhalte aus Mediatheken einbetten: http://mediathek.einbetten.reloado.com -->';
return $ou;
}
?>