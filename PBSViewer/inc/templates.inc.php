<?php
/*
    This program 'PBSViewer' also known as Punkbuster Screenshot Viewer, 
    will download pb screens. Those downloaded screens are published on
    your website.
    
    Copyright (C) 2010  B.S. Rijnders aka BandAhr

    PBSViewer is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    PBSViewer is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with PBSViewer.  If not, see <http://www.gnu.org/licenses/>.
    
    ____________________
    contact information:
    --------------------
    mail:		brettrijnders@gmail.com
    website:	http://www.beesar.com       

*/

function template_header()
{	
	global $str;
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="<?php echo $str["META_DESC"];?>">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, <?php echo CLAN_NAME.', '.CLAN_TAG.', '.CLAN_GAME;?>">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title><?php echo $str["TITLE"];?></title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico">

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

<!--
	For the 2 plugins tooltips and autocomplete it needs 2 .js scripts:
	- jquery.bgiframe.min.js
	- jquery.dimensions.js
	
	those can be found on dev.jquery.com trunk location or in 'inc/js/jquery/plugins/tooltip/lib'
	
	Scripts used for autocomplete
	jquery.bgiframe.min.js is also used by tooltip plugin
	
-->
<link rel="stylesheet" href="http://dev.jquery.com/view/trunk/plugins/autocomplete/jquery.autocomplete.css" type="text/css" />
<script type="text/javascript" src="http://dev.jquery.com/view/trunk/plugins/autocomplete/lib/jquery.bgiframe.min.js"></script>
<script type="text/javascript" src="http://dev.jquery.com/view/trunk/plugins/autocomplete/jquery.autocomplete.js"></script>

<!-- 
Scripts used for tooltip
jquery.dimensions.js is also used by autocomplete plugin	
-->
<script type="text/javascript" src="inc/js/jquery/plugins/tooltip/lib/jquery.dimensions.js"></script>
<script type="text/javascript" src="inc/js/jquery/plugins/tooltip/jquery.tooltip.js"></script>



<script type="text/javascript">


//	after document has loaded
$(document).ready(function()
	{	
		
		
		function EnableAutoComplete() 
		{
			var sID = $("#sID").val();	
								
			var data = "<?php echo auto_complete_data_names();?>".split(" ");
				
			
			if (sID!='name')
			{	
				data = "";		
				$("#input_search").flushCache();	
			}	

			$("#input_search").autocomplete(data);
			
			
		}
		
		$("select").change(EnableAutoComplete);
		EnableAutoComplete();
		
		
			
		//	when hovering over an image, make image a bit larger
		$("img.hover").hover(
			
          function () {
          	//	stop() is used to prevent animation Queue Buildup, see following sites for more information:
          	//	http://api.jquery.com/stop/
          	//	http://www.learningjquery.com/2009/01/quick-tip-prevent-animation-queue-buildup
          	$(this).stop(true,true).fadeTo('fast',0.5);
            $(this).stop(true,true).fadeTo('slow',1);            
          },
          function () {}
        );
		
		
        
        // used for tooltips
		$(function() 
		{		
			$('#scrnInfo a').tooltip({
			track: true,
			delay: 0,
			showURL: false,
			showBody: " - ",
			fade: 250
			});

		});
		
		
		
		
	}
)


</script>

</head>

<body onload="document.search_form.input.focus(); document.search_form.input.select();">
<a name="start"></a>
	<?php 

template_login_top_menu();	
	
//	first check if install map is gone
if(!check_install_del()) template_install_del();

if(!is_CHMOD_755()) template_chmod_755();

if(!check_version())
{
	template_new_version();
}
	
template_logo_header();
}

// new since version 2.0.0.0
function template_logo_header()
{
	?>
	
		<table width="100%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a></td>
  </tr>
</table>
<br>
	
	<?php 
}

//	new header added since version 1.1.2.1
function template_header_detailed_page()
{
	global $str;
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="<?php echo $str["META_DESC"];?>">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, <?php echo CLAN_NAME.', '.CLAN_TAG.', '.CLAN_GAME;?>">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title><?php echo $str["TITLE"];?></title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 
<!-- Load zoom tool created by Janos Pal Toth
// For more information go to http://valid.tjp.hu/tjpzoom/
-->
<script type="text/javascript" src="inc/js/zoom/tjpzoom.js"></script> 
<script type="text/javascript" src="inc/js/zoom/tjpzoom_config_PBSViewer.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script src="inc/js/jquery/plugins/tooltip/lib/jquery.bgiframe.js" type="text/javascript"></script>
<script src="inc/js/jquery/plugins/tooltip/lib/jquery.dimensions.js" type="text/javascript"></script>
<script src="inc/js/jquery/plugins/tooltip/jquery.tooltip.js" type="text/javascript"></script> 

<!-- This script is used to show extra screen info during hover-->
<script type="text/javascript">
$(function() {
	
$('#scrnInfo a').tooltip({
	track: true,
	delay: 0,
	showURL: false,
	showBody: " - ",
	fade: 250
});

});
</script>
</head>

<body>
<a name="start"></a>
	
	<?php 
	
//	first check if install map is gone
if(!check_install_del()) template_install_del();

if(!is_CHMOD_755()) template_chmod_755();

	if(!check_version())
	{
		template_new_version();
	}

	?>
	
	<table width="100%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a></td>
  </tr>
</table>
<br>
	
	<?php 
}

//	templated appears when map install does exist
function template_install_del()
{
	?>
	
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class=".bg_install_del_warning">
  <tr>
    <td align="center"><span class="txt_warning"><strong>Please delete '<em> install </em>' directory to avoid security problems!</strong></span></td>
  </tr>
</table>
<br>
	
	<?php 
}

//	new since version 2.0.0.0
function template_chmod_755()
{
	?>
	
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class=".bg_install_del_warning">
  <tr>
    <td align="center"><span class="txt_warning"><strong>Please CHMOD '<em> inc </em>' directory to '755' to avoid security problems!</strong></span></td>
  </tr>
</table>
<br>
	
	<?php 	
}

function template_new_version()
{
		?>
		
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="bg_new_version">
  <tr>
    <td align="center"><strong>There is a new version available, check <a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><em>www.beesar.com</em></a> for more info! </strong></td>
  </tr>
</table>
<br>
		<?php 	
}

function template_admin_tools()
{
	global $str;
	
	if(is_admin())
	{
	?>
	
<?php if(get_request_status()==1)
{?>
                                <table width="100%" border="0" class="header_menu_bg_admin">
                                  <tr>
                                    <td width="20%"><span class="txt_light"><strong><?php echo $str['ADM_NEW_MSG'];?>:</strong></span></td>
                                    <td><span class="txt_admin_message"><strong><?php echo $str['ADM_UPDATE_REQ'];?></strong></span></td>
                                  </tr>
                                </table>
<?php }?>                                
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="header_menu_bg_admin" align="center">
                                  
                                <tr>
                                    <td width="20%" align="left"><br><span class="txt_light"><strong><?php echo $str['ADM_ADMIN'];?>:</strong></span></td>
                                  <td align="left"><br><input type="submit" name="Update" id="Update" value="<?php echo $str['ADM_UPDATE'];?>" class="buttons" onmouseover="this.className='buttons_hover'" onmouseout="this.className='buttons'">
                                  <?php  if (RESET){?>
                                  &nbsp;
                                  
                                    <input type="submit" name="reset" id="reset" value="<?php echo $str['ADM_RESET'];?>" class="buttons" onmouseover="this.className='buttons_hover'" onmouseout="this.className='buttons'">
                                  
                                  <?php }?>
                                  &nbsp;
                                  <input type="submit" name="ACP" id="ACP" value="<?php echo $str['ADM_ACP'];?>" class="buttons" onmouseover="this.className='buttons_hover'" onmouseout="this.className='buttons'">
                                  </td>
                                  </tr>
                                  
</table>
	
	<?php 
	}	
}

function template_search($current_scrn_nr)
{
	global $str;
	
	?>
	    
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="bg_main_table">
  <tr>
    <td>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" class="header_main_bg"><form action="" method="get" name="search_form">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center" class="header_menu_bg"><span class="txt_light"><?php echo $str["SM_WILDCARD"];?></span></td>
            </tr>
          </table>
                 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_menu_bg">
            <tr>
              <td width="20%" align="center"><select name="sID" id="sID" class="option_search_bg">
                <option value="filename"><?php echo $str['SM_FILENAME'];?></option>  
                <option value="name" selected><?php echo $str['SM_NAME'];?></option>
                <option value="guid"><?php echo $str['SM_GUID'];?></option>
                </select>              </td>
              <td width="50%" align="center"><input name="input" type="text" id="input_search" value="" onclick="this.focus();" size="70" class= "search_field_bg" onmouseover="this.className='search_field_hover';" onmouseout="this.className='search_field_bg';"></td>
                <td width="10%" align="left">&nbsp;<input type="submit" name="search" id="search" value="<?php echo $str['SM_SEARCH'];?>" class="buttons" onmouseover="this.className='buttons_hover'" onmouseout="this.className='buttons'"></td>
                <td align="left"><input type="submit" name="show_all" id="show_all" value="<?php echo $str['SM_SHOW_ALL'];?>" class="buttons" onmouseover="this.className='buttons_hover'" onmouseout="this.className='buttons'"></td>
                <td align="left"> 
                </td>
              </tr>
            <tr>
              <td width="20%" align="center">&nbsp;</td>
              <td width="50%" align="center"><select name="year" id="year">
                <option value="all_years"><?php echo $str['SM_ALL_YEARS'];?></option>
                <?php 
                $dates	=	get_dates();
                foreach ($dates[0] as $year)
                {
                	echo "<option value=".$year.">".$year."</option>";
                }
                ?>
              </select>
                -
                <select name="month" id="month">
                  <option value="all_months" selected><?php echo $str['SM_ALL_MONTHS'];?></option>
                  <?php 
                  foreach ($dates[1] as $month)
                  {
                  	//	seperate the month names and numbers
                  	$month_data	=	explode(',',$month);
                  	
                  	echo "<option value=".$month_data[1].">".$month_data[0]."</option>";
                  }
                  ?>
                </select>
                -
                <select name="day" id="day">
                  <option value="all_days"><?php echo $str['SM_ALL_DAYS'];?></option>
                  <?php 
                  foreach ($dates[2] as $day)
                  {
                  	echo "<option value=".$day.">".$day."</option>";
                  }
                  ?>
                </select>
                -
                <select name="hour" id="hour">
                  <option value="all_hours"><?php echo $str['SM_ALL_HOURS'];?></option>
                  <?php 
                  foreach ($dates[3] as $hour)
                  {
                  	echo "<option value=".$hour.">".$hour."</option>";
                  }
                  ?>                  
                </select></td>
              <td width="10%" align="left">&nbsp;<input type="submit" name="select" id="select" value="<?php echo $str['SM_SELECT'];?>" class="buttons" onmouseover="this.className='buttons_hover'" onmouseout="this.className='buttons'"></td>
              <td align="left"><input type="submit" name="show_available" id="show_available" value="<?php echo $str['SM_SHOW_ALL_AVAILABLE'];?>" class="buttons" onmouseover="this.className='buttons_hover'" onmouseout="this.className='buttons'"></td>
              <td align="left">&nbsp;</td>
            </tr>
            </table>
       <br>
       <?php template_info_screens($current_scrn_nr);?>
       <br>       
	             <?php template_admin_tools();?>
          </form>        </td>
      </tr>
    </table>
    
	<?php 
}

//	info about the gathered screens
//	this template is new since 1.2.2.1
function template_info_screens($current_scrn_nr)
{
	global $str;
	
	?>
	
<table width="100%" border="0" align="center" class="header_info_screen_bg">
  <tr>
    <td class="header_info_screen_row1"><span class="txt_light"><strong><?php echo $str['STAT_UNIQUE_PLAYERS'];?>:</strong></span></td>
    <td class="header_info_screen_row1"><span class="txt_light"><?php echo get_nr_unique_players();?></span></td>
    <td class="header_info_screen_row1"><span class="txt_light"><strong><?php echo $str['STAT_TOTAL_COMPLETE'];?>:</strong></span></td>
    <td class="header_info_screen_row1"><span class="txt_light"><?php echo get_nr_complete_screens();?></span></td>
  </tr>
  <tr>
    <td width="25%" class="header_info_screen_row2"><span class="txt_light"><strong><?php echo $str['STAT_MOST_SCREENS'];?>:</strong></span></td>
    <td width="25%" class="header_info_screen_row2"><span class="txt_light"><?php 
    
    $guid	=	get_player_most_complete_screens();
    $name	=	get_player_name_by_guid($guid);
    echo "<a href='?sID=guid&amp;input=".$guid."&amp;search=Search&amp;year=all_years&amp;month=all_months&amp;day=all_days&amp;hour=all_hours' target='_self'>".$name."</a>";
    
    ?></span></td>
    <td width="25%" class="header_info_screen_row2"><span class="txt_light"><strong><?php echo $str['STAT_TOTAL_INCOMPLETE'];?>:</strong></span></td>
    <td width="25%" class="header_info_screen_row2"><span class="txt_light"><?php echo get_nr_incomplete_screens();?></span></td>
  </tr>
  <tr>
    <td class="header_info_screen_row1"><span class="txt_light"><strong><?php echo $str['STAT_MOST_INC_SCREENS'];?>:</strong></span></td>
    <td class="header_info_screen_row1"><span class="txt_light"><?php 
    
    $guid	=	get_player_most_incomplete_screens();
    $name	=	get_player_name_by_guid($guid);
    echo "<a href='?sID=guid&amp;input=".$guid."&amp;search=Search&amp;year=all_years&amp;month=all_months&amp;day=all_days&amp;hour=all_hours' target='_self'>".$name."</a>";
    
    ?></span></td>
    <td class="header_info_screen_row1"><span class="txt_light"><strong><?php echo $str['STAT_CURRENT_WIN_SCREENS'];?>:</strong></span></td>
    <td class="header_info_screen_row1"><span class="txt_light"><?php echo $current_scrn_nr;?></span></td>
  </tr>
</table>

	
	
	<?php 
}


//	this template is new since 1.1.2.1
//	It is used to show detailed screen information
function template_detailed_screen($fid)
{
	global $str;
	
	$guidlength=guidlength;
	$guidlength_short=guidlength_short;
	
	//	this is needed to make automatic class(css) altering of rows
	$row_nr		=	1;		//	odd nr get different class then even nr
	
	if($data	=	get_detailed_screen_info($fid))
	{

		$name	=	$data[0];
		$guid	=	$data[1];
		$date	=	$data[2];

	//	get aliases of player
	//	$alias	=	get_alias($guid,addslashes($name));
	$alias	=	get_alias($guid,mysql_real_escape_string($name));
			
	?>
	

<SCRIPT>

var imageURL = "style/img/zoom_disabled.gif";

function changeImage() 
{
     if (document.images) 
     {
          if (imageURL == "style/img/zoom.gif") imageURL = "style/img/zoom_disabled.gif";
          else imageURL = "style/img/zoom.gif";

         document.zoomIMG.src = imageURL;
     }
}

</SCRIPT>

<table width="90%" border="0" align="center">
  <tr>
  <td align="center" valign="top" class="bg_detailed_screen_tools" id="scrnInfo"><a href="<?php echo "inc/imgSave.inc.php?saveIMG=".$fid;?>" title="<?php echo $str["DETSCRN_TOOLS_SAVE_TITLE"];?> - <?php echo $str["DETSCRN_TOOLS_SAVE_COMMENT"];?>"><img src="style/img/save.gif" width="32" height="32" alt="<?php echo $str["DETSCRN_TOOLS_ZOOM_ENABLE"];?>" border="0"></a>
    &nbsp;<a href="#" onclick="TJPzoomswitch(document.getElementById('unique1337'))" title="<?php echo $str["DETSCRN_TOOLS_ZOOM_TITLE"];?> - <br><ul>
  <li><?php echo $str["DETSCRN_TOOLS_ZOOM_COMMENT"];?></li>
  <li><?php echo $str["DETSCRN_TOOLS_ZOOM_COMMENT_2"];?></li>
  <li><?php echo $str["DETSCRN_TOOLS_ZOOM_COMMENT_3"];?></li>
  <li><?php echo $str["DETSCRN_TOOLS_ZOOM_COMMENT_4"];?></li>
</ul>
<?php if (get_browser_info()=='opera')
{
	echo "<strong>".$str["DETSCRN_TOOLS_ZOOM_COMMENT_5"]."</strong>";
}?>

"><img src="style/img/zoom_disabled.gif" width="32" height="32" alt="<?php echo $str["DETSCRN_TOOLS_ZOOM_ENABLE"];?>" border="0" onclick="changeImage()" NAME="zoomIMG"></a>
<!--
Will be implemented later on, probably version 2.2.0.0
&nbsp;<a href="#"><img src="style/img/gamma_min.png" width="32" height="32" alt="" border="0" NAME="gamma_min"></a>
&nbsp;<a href="#"><img src="style/img/gamma_plus.png" width="32" height="32" alt="" border="0" NAME="gamma_plus"></a>
&nbsp;<a href="#"><img src="style/img/negative.png" width="32" height="32" alt="" border="0" NAME="negative"></a>

-->

</td>

  </tr>
  
  <tr>
    <td align="center" valign="top" class="body_bg_detailed_screen">
    <?php 
    $IMGsrc = 'download/'.$fid.'.png';
    list($widthIMG, $heightIMG, $typeIMG, $attrIMG) = getimagesize($IMGsrc);
    
    ?>
    
    <table cellspacing="0" cellpadding="0" border="0"><tr><td width="50%"></td><td>
<img src="<?php echo $IMGsrc;?>" style="width:<?php echo $widthIMG;?>px; height: <?php echo $heightIMG;?>px;" onmouseover="TJPzoomif(this);" id="unique1337"" alt="<?php echo $fid.'png';?>">
</td><td width="50%"></td></tr></table>
</td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center">
      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_FILE"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><?php echo $fid.'.png';?></td>
      </tr>
      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_PLAYER"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><?php echo $name;?></td>
      </tr>
      <?php 
      //	only show clanbase information if admin has configured it in ACP
      if (CBGAMEID!='none')
      {
      ?>
      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_CB"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><?php echo "<a href=\"http://clanbase.ggl.com/personlist.php?guidid=".CBGAMEID."&amp;guidvalue=".substr($guid,$guidlength-8)."\" target=\"_blank\">".$name."</a>";?></td>
      </tr>
      <?php 
      }
      if($alias)
      {
      	// bug fix: only show alias if there are any
      	// don't show alias if there is only one single nickname      	
      	if (count($alias)>0)
      	{
      ?>
      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_ALIASES"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>">
        <?php 

        echo "<p>".$str["DETSCRN_ALIASES_2"]." ".count($alias)." ".$str["DETSCRN_ALIASES_3"].":</p>";
        
        echo "<ul>";
        foreach ($alias	as $name)
        {
        	 echo "<li>".$name."</li>";
        }
        echo "</ul>
             </td>
      </tr>";
      	}
      }
      ?>
      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_TAKEN"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><?php echo $date;?></td>
      </tr>
      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_GUID"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><label>
          <input type="text" name="GUID" id="GUID" size="100" value="<?php echo $guid;?>" onclick="this.select();">
        </label></td>
      </tr>
      <tr>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_GUID_SHORT"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><label>
          <input type="text" name="GUID_short" id="GUID_short" size="100" value="<?php echo substr($guid,$guidlength-8);?>" onclick="this.select();">
        </label>
        </td>
      </tr>
      <?php 
      
      			$md5_valid	=	false;
				$logged		=	false;
				
				//	get info from log data
				if($log_data	=	get_extra_log_data($fid))
				{
					$logged		=	true;
					$md5_screen	=	$log_data[0];
					$ip_player	=	$log_data[1];
					
					if($md5_screen==get_md5("download/".$fid.".png")) $md5_valid=true;
				}
				
				if($logged)
				{
					if($md5_valid)
					{
						
						?>
						
											      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_IP"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><label>
          <input type="text" name="IP" id="IP" size="100" value="<?php echo $ip_player;?>" onclick="this.select();">
        </label></td>
      </tr>
						
											      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><span class="md5_valid"><?php echo $str["DETSCRN_MD5_VALID"];?>:</span></strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><label>
          <input type="text" name="MD5" id="MD5" size="100" value="<?php echo get_md5('download/'.$fid.'.png')?>" onclick="this.select();">
        </label></td>
      </tr>
						
						<?php 
						
					}
					//	mismatch!
					else 
					{
					?>
																      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_IP"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><label>
          <input type="text" name="IP" id="IP" size="100" value="<?php echo $ip_player;?>" onclick="this.select();">
        </label></td>
      </tr>
					
					      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><span class="md5_mismatch"><?php echo $str["DETSCRN_MD5_INVALID"];?></span></strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>">
        </td>
      </tr>
					
					
					      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_MD5_SCREEN"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><label>
          <input type="text" name="MD5" id="MD5" size="100" value="<?php echo get_md5('download/'.$fid.'.png')?>" onclick="this.select();">
        </label></td>
      </tr>
      
            <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_MD5_LOG"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><label>
          <input type="text" name="MD5" id="MD5" size="100" value="<?php echo $md5_screen;?>" onclick="this.select();">
        </label></td>
      </tr>
					
					<?php 
							
						
					}
				}
				else 
				{
					//	show without extra info
					?>
					
					      <tr>
        <td width="15%" align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';}?>"><strong><?php echo $str["DETSCRN_MD5_HASH"];?>:</strong></td>
        <td align="left" class="<?php if($row_nr %2 == 0) {echo 'first_row_detailed_screen';}else{echo'second_row_detailed_screen';} $row_nr++;?>"><label>
          <input type="text" name="MD5" id="MD5" size="100" value="<?php echo get_md5('download/'.$fid.'.png')?>" onclick="this.select();">
        </label></td>
      </tr>
					<?php 
				}
      
      ?>

    </table>
    
    <?php
    
    if (get_nr_screens_by_guid($guid)>1)
    {    
    	echo "<a href=\"./?sID=guid&input=".$guid."&search=Search\">".$str["DETSCRN_SHOW_MORE"]." (".get_nr_screens_by_guid($guid).")</a><br><br>";
    }
?>

    
      <table width="100%" border="0">
        <tr>
        <td align="center" class="bg_detailed_screen_back_table"><a href="./" title="Go back" target="_self"><?php echo $str["DETSCRN_BACK"];?></a></td>
        </tr>
    </table></td>
  </tr>
  </table>

<br>
<table width="80%" border="0" align="center">
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>
</table>


	<?php 
	}
	//	show error msg if screen does not exist
	else 
	{

	template_detailed_screen_error('Screen does not exist','Can\'t find information about screen','Try to use another filename(=fid)');	
		
	}
	
	
}

//	new template function since 1.1.2.1
function template_detailed_screen_error($error,$result,$hint)
{
	?>
		
		
		<table width="90%" border="0" align="center">
  <tr>
    <td align="center" valign="top" class="body_bg_detailed_screen">	<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_error_bg">
  <tr>
    
    <td align="center"><span class="txt_light">::</span> <span class="header_error_txt"> Error: <?php echo $error;?></span> <span class="txt_light">::</span></td>

  </tr>
  <tr>
    <td colspan="3" class="body_error_bg"><?php echo $result.'<br>'.$hint;?></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0">
        <tr>
        <td align="center" class="bg_detailed_screen_back_table"><a href="./" title="Go back" target="_self">Go back</a></td>
        </tr>
    </table></td>
  </tr>
  </table>

<br>
<table width="80%" border="0" align="center">
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>
</table>
		
	 
	<?php 
}

//	new template added since version 1.2.2.1
//	this one is used on main page
function template_show_main($nr,$current_scrn_nr=nr_screens_main)
{

	template_search($current_scrn_nr);

	echo "<!-- div is used to support multiple tooltips-->
<div id=\"scrnInfo\">";

?>

	      <table width="100%" border="0" cellspacing="10" cellpadding="0" align="center">
	      
<?php 
show_main_screens($nr);
echo "</table>";

	echo "</div>";


}

function template_show_all($nr,$current_scrn_nr=nr_screens_main)
{

	template_search($current_scrn_nr);
	echo "<!-- div is used to support multiple tooltips-->
<div id=\"scrnInfo\">";

?>

	      <table width="100%" border="0" cellspacing="10" cellpadding="0" align="center">
	       
<?php 
show_all_screens($nr);
echo "</table>";
echo "</div>";


}

// this template is new since 1.2.2.3
// only show available screens
function template_show_available($nr,$current_scrn_nr=nr_screens_main)
{

	template_search($current_scrn_nr);
	
	echo "<!-- div is used to support multiple tooltips-->
<div id=\"scrnInfo\">";

?>
	      <table width="100%" border="0" cellspacing="10" cellpadding="0" align="center">
	       
<?php 
// show all available screens by setting 2nd parameter to true
show_all_screens($nr,true);
echo "</table>";

	echo "</div>";


}

//	this template is new since 1.2.2.1
function template_show_date_selection($nr,$data,$current_scrn_nr)
{

	template_search($current_scrn_nr);
	
	echo "<!-- div is used to support multiple tooltips-->
<div id=\"scrnInfo\">";

		
?>
	      <table width="100%" border="0" cellspacing="10" cellpadding="0" align="center">
	       
<?php 
show_date_selection($nr,$data);
echo "</table>";

	echo "</div>";


}

function template_show_fid($nr,$fileName,$current_scrn_nr)
{
	template_search($current_scrn_nr);


	echo "<!-- div is used to support multiple tooltips-->
<div id=\"scrnInfo\">";

	
		?>
	      <table width="100%" border="0" cellspacing="10" cellpadding="0">
<?php 

show_fid_screens($nr,$fileName);
echo "</table>";


	echo "</div>";

}

function template_show_guid($nr,$guid,$current_scrn_nr)
{
	template_search($current_scrn_nr);


	echo "<!-- div is used to support multiple tooltips-->
<div id=\"scrnInfo\">";

	
		?>
	      <table width="100%" border="0" cellspacing="10" cellpadding="0">
<?php 

show_guid_screens($nr,$guid);
echo "</table>";


	echo "</div>";

}


function template_show_name($nr,$name,$current_scrn_nr)
{
	template_search($current_scrn_nr);


	echo "<!-- div is used to support multiple tooltips-->
<div id=\"scrnInfo\">";

	
		?>
	      <table width="100%" border="0" cellspacing="10" cellpadding="0">
<?php 

show_name_screens($nr,$name);
echo "</table>";


	echo "</div>";

}

//	please don't remove this, thank you.
function template_copyright()
{
	// this is used to gather copyright and version number information
	$nfo_data	=	file('http://beesar.com/pbs_viewer/nfo');
	$version	=	file('VERSION');
	if($nfo_data[1]!='')
	{
		echo $nfo_data[1].'<br>';
		echo 'V '.$version[0].' ';
		echo 'Powered by <a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank">PBSViewer</a>';
	}
	// nfo data on beesar is not available
	else
	{
		echo 'Copyright &copy; '.date('Y').', BandAhr, <a href="http://www.beesar.com" target="_blank">www.beesar.com</a><br>';
		echo 'V '.$version[0].' ';
		echo 'Powered by <a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank">PBSViewer</a>';
	}

}

function template_error_msg($error,$result,$hint='')
{

	?>
	 
                 <tr>
                  <td>
	<br>
	<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_error_bg">
  <tr>
    
    <td align="center"><span class="txt_light">::</span> <span class="header_error_txt"> Error: <?php echo $error;?></span> <span class="txt_light">::</span></td>

  </tr>
  <tr>
    <td colspan="3" class="body_error_bg"><?php echo $result.'<br>'.$hint;?></td>
  </tr>
</table>
	<br>
	</td>
                </tr>
	<?php 
	
}

//	new since version 1.2.2.1
//	is used to for request update for example
function template_custom_msg($title, $msg)
{
	?>
	
	
		<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
  <tr>
    
    <td align="center"><span class="txt_light">::</span> <span class="header_msg_txt"><?php echo $title;?></span> <span class="txt_light">::</span></td>

  </tr>
  <tr>
    <td colspan="3" class="body_msg_bg"><?php echo $msg;?></td>
  </tr>
</table>

	</body>
</html>
	
	<?php 
	
}

//	new template since version 1.2.2.1
//	this will give a request button on page
function template_request()
{
	
	global $str;
?>

<form action="" method="get">                <?php 
                if(get_request_status()==0)
                {
                	?>
                	<label><input type="submit" name="request_update" id="request_update" value="<?php echo $str["FOOTER_REQUEST_UPDATE"];?>" class="req_button" onmouseover="this.className='buttons_hover'" onmouseout="this.className='req_button'">
                </label>
                	<?php 
                	
                }
                ?></form>

<?php 
}

function template_footer($update_time,$lastUpdate,$startTime)
{
	global $str;
	
	?>
	<div align="center"><a href="#start" target="_self"><strong><?php echo $str['FOOTER_GO_UP'];?></strong></a>
</div>
    <br></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_1">
    <br>
    <?php template_request();?>
    <br>
      <table width="40%" border="0" cellpadding="0" cellspacing="0" class="footer_main_bg_1_row_1">
        <tr>
          <td align="center"><?php echo $str["FOOTER_PAGE_GENERATED"]." ".get_loadTime($startTime,4)." ".$str["FOOTER_SECONDS"];?></td>
        </tr>
      </table>
      <table width="40%" border="0" cellpadding="0" cellspacing="0" class="footer_main_bg_1_row_2">
        <tr>
          <td align="center" class="bg_main_table"><?php  update_info($update_time,$lastUpdate);?></td>
        </tr>
      </table>
      
        <p>
    <a href="http://validator.w3.org/check?uri=referer" target="_blank"><img
        src="style/img/valid-html401-blue.png"
        alt="Valid HTML 4.01 Transitional" height="31" width="88" border="0"></a>
      <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank"><img src="style/img/gplv3-88x31.png" alt="Small GPLv3 logo" width="88" height="31" border="0"></a>
      <a href="https://code.google.com/p/pbsviewer/" target="_blank"><img
        src="style/img/google_code_project_hosting.gif"
        alt="Google Code project hosting" height="34" width="34" border="0"></a>
      
      
      </p>
  
      
        <br>
    </td>
    </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
    </tr>
</table>
 
</body>
</html>
	
	<?php 

}

//	new footer added since version 1.1.2.1
function template_footer_detailed_page()
{
	?>
	
	</body>
</html>
	
	<?php 
}

//	new since version 2.1.0.0
// login template for admin
function template_login()
{
	global $str;
	
	?>
	
	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer) - Login</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 
</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span><span class="header_msg_txt"><strong> <?php echo $str["LOGIN_MENU_TITLE"];?> </strong></span><span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><br>
          <form name="login" method="post" action="" autocomplete="off">
            <table width="50%" border="0">
              <tr>
                <td><strong><?php echo $str["LOGIN_MENU_USERNAME"];?></strong></td>
                <td align="center"><label>
                  <input type="text" name="name" id="name" class= "search_field_bg" onmouseover="this.className='search_field_hover';" onmouseout="this.className='search_field_bg';">
                </label></td>
              </tr>
              <tr>
                <td><strong><?php echo $str["LOGIN_MENU_PASSWORD"];?></strong></td>
                <td align="center"><label>
                  <input type="password" name="password" id="password" class= "search_field_bg" onmouseover="this.className='search_field_hover';" onmouseout="this.className='search_field_bg';">
                </label></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><label>
                  <input type="submit" name="login" id="login" value="<?php echo $str["LOGIN_MENU_BUTTON"];?>">
                </label></td>
                </tr>
            </table>
          </form>
          <br>
          <a href="?reset=1" target="_self"><?php echo $str["LOGIN_MENU_FORGOT"];?></a><br>

</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>		
	
	<?php
}

function template_reset_password()
{
	global $str;
	
	?>
	
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer) - Login</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 
</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span><span class="header_msg_txt"><strong> <?php echo $str["LOGIN_RESET_TITLE"];?> </strong></span><span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><p><?php echo $str["LOGIN_RESET_MSG"];?></p>
          <form name="reset" method="post" action="" autocomplete="off">
            <label>
              <input type="text" name="mail_reset" id="mail_reset" class= "search_field_bg" onmouseover="this.className='search_field_hover';" onmouseout="this.className='search_field_bg';">
            </label>
            <label> 
              <input type="submit" name="submit" id="Submit" value="<?php echo $str["LOGIN_RESET_SUBMIT"];?>">
            </label>
          </form>
          <p>&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>		
	
	<?php
}

function template_reset_invalid_mail()
{
	global $str;
	
	?>
	
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer) - Login</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 
</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span><span class="header_msg_txt"><strong> <?php echo $str["LOGIN_INVALID_MAIL_TITLE"];?> </strong></span><span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><p><?php echo $str["LOGIN_INVALID_MAIL_MSG"];?><a href="" target="_self" onclick="history.go(-1)"> <?php echo $str["LOGIN_GO_BACK"];?></a></p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>		
	
	
	<?php	
}

function template_reset_correct_mail($mail)
{
	global $str;
	
	?>
	
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer) - Login</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 
</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span><span class="header_msg_txt"><strong> <?php echo $str["LOGIN_CORRECT_MAIL_TITLE"];?> </strong></span><span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><p><?php echo $str["LOGIN_CORRECT_MAIL_MSG"];?> '<?php echo $mail;?>'. <?php echo $str["LOGIN_CORRECT_MAIL_MSG_2"];?></p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>		
	
	<?php
}

function template_reset_password_succesfully($user,$password)
{
	
	global $str;
	?>
	
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer) - Login</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 
</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span><span class="header_msg_txt"><strong><?php echo $str["LOGIN_RESET_TITLE"];?></strong></span><span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><p><?php echo $str["LOGIN_RESET_SUCC_MSG"];?> <?php echo $str["LOGIN_RESET_SUCC_MSG_2"];?> <a href="login.php" target="_blank"><?php echo $str["LOGIN_RESET_SUCC_MSG_3"];?></a> <?php echo $str["LOGIN_RESET_SUCC_MSG_4"];?>:</p>
          <p><?php echo $str["LOGIN_MENU_USERNAME"];?>: <?php echo $user;?><br>
            <?php echo $str["LOGIN_MENU_PASSWORD"];?>:<?php echo $password;?>
          </p>
          <p><?php echo $str["LOGIN_RESET_SUCC_MSG_5"];?></p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>		
	
	<?php
}

function template_login_failed()
{
	global $str;
	
	?>
	
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer) - Login</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 
</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span><span class="header_msg_txt"><strong><?php echo $str["LOGIN_FAIL_TITLE"];?></strong></span><span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><?php echo $str["LOGIN_FAIL_MSG"];?> <a href="" target="_self" onclick="history.go(-1)"><?php echo $str["LOGIN_GO_BACK"];?></a><br>
          <br>
          <a href="?reset=1" target="_self"><?php echo $str["LOGIN_MENU_FORGOT"];?></a><br>

</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>	
	
	<?php	
}

function template_login_visitor_failed()
{
	global $str;
	
	?>
	
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer)</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 
</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span> <span class="header_msg_txt"><strong> <?php echo $str["LOGIN_VISITOR_TITLE"];?> </strong></span><span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><p><?php echo $str["LOGIN_VISITOR_INVALID_MSG"];?> <a href="" target="_self" onclick="history.go(-1)"><?php echo $str["LOGIN_GO_BACK"];?></a><br>

</p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>	
	
	<?php
}

//	template for when user has logged in successfully
function template_login_success()
{
	global $str;
	
	?>
	
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer) - Login</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 

<meta http-equiv="refresh" content="5;URL=./" />

</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span><span class="header_msg_txt"><strong> <?php echo $str["LOGIN_SUCCESS_TITLE"];?> </strong></span><span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><?php echo $str["LOGIN_SUCCESS_MSG"];?> <a href="./" target="_self"><?php echo $str["LOGIN_SUCCESS_MSG_2"];?></a><br>          
          <br>

</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>	
	
	<?php
	
}

//	template for when user has logged in successfully
function template_logout_success()
{
	global $str;
	
	?>
	
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer) - Login</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 

<meta http-equiv="refresh" content="5;URL=./" />

</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
		  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span><span class="header_msg_txt"><strong> <?php echo $str["LOGOUT_TITLE"];?> </strong></span><span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><?php echo $str["LOGOUT_MSG"];?> <a href="./" target="_self"><?php echo $str["LOGOUT_MSG_2"];?></a><br>          
          <br>

</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>
	
	<?php
	
}

//	small menu for user to login
function template_login_top_menu()
{
	global $str;
	
	//	first check if user already is logged in
	if(is_admin())
	{
		?>
		
		<table width="100%" border="0">
  <tr>
    <td align="right"><?php echo $str["LOGIN_WELCOME"]." ".get_admin_name();?> | <a href="login.php?logout=1"><?php echo $str["LOGOUT_HEADER_MAIN"];?></a></td>
  </tr>
</table>
		
		<?php
	}
	else 
	{
		?>
		
		<table width="100%" border="0">
  <tr>
    <td align="right"><a href="login.php" target="_self"><?php echo $str["LOGIN_HEADER_MAIN"];?></a></td>
  </tr>
</table>
		
		<?php
	}
}

//	new since version 2.1.0.0
// 	show this template when visitor is not allowed to access page
function template_denied_no_perm()
{
	global $str;
	
	?>
	
	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer)</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 
</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span> <span class="header_msg_txt"><strong> <?php echo $str['MISC_ACCESS_DENIED_NO_PERM_TITLE'];?> </strong></span> <span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><br>
<?php echo $str['MISC_ACCESS_DENIED_NO_PERM'];?><br><br>

</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>	
	
	<?php 
}

//	show this page when PBSViewer is private
function template_denied_private()
{
	global $str;
	
	template_login_top_menu();
	?>
	
	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer) - Private</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script> 
</head>

<body>


<script type="text/javascript">
//	used to show login form
$(document).ready(function()
						   {
							   $("#login_form").hide()
							   $("a").click(function()
													 {
														 $("#login_form").show("slow")
													 })
						   }
						   )
  </script>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span> <span class="header_msg_txt"><strong> <?php echo $str['PRIVATE_TITLE'];?> </strong></span><span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><p><br> 
          <?php echo $str['PRIVATE_MSG'];?></p>
          <p>
          <a href="#" target="_self"><?php echo $str['PRIVATE_CLICK_HERE'];?></a>
          </p>
          <div id="login_form">
          <form name='login' method='post' action='' autocomplete="off">
            <label><strong><?php echo $str['PRIVATE_PASSWORD'];?></strong>:
<input type='password' name='password' id='password' class= "search_field_bg" onmouseover="this.className='search_field_hover';" onmouseout="this.className='search_field_bg';">
            </label>
            <label>
            <input type='submit' name='login' id='login' value='<?php echo $str['PRIVATE_LOGIN'];?>'></label></form>
            </div>
<br>

</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>	
	
	<?php 
}

//	new since version 2.1.0.0
// 	show this template when visitor is accessing a forbidden page
function template_denied()
{
	global $str;
	?>
	
	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="See captured punkbuster screenshots online with punkbuster (PB) Screenshot Viewer (PBSViewer).">
<meta name="keywords" content="pb, view, viewer, punkbuster, php, parser, screens, capture, gaming, cheat">
<meta name="robot" content="index,follow">
<meta name="copyright" content="Copyright &copy; 2009 B.S. Rijnders aka BandAhr. All rights reserved">
<meta name="author" content="B.S. Rijnders">
<meta name="revisit-after" content="7">
<title>Punkbuster (PB) Screenshot Viewer (PBSViewer)</title>

<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="style/img/favicon.ico"> 
</head>

<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<table width="60%" border="0" align="center">
  <tr>
    <td align="center"><a href="http://www.beesar.com/work/php/pb-screenshot-viewer/" target="_blank"><img src="style/img/header.png" alt="free php script" width="400" height="100" border="0"></a><br>
<br><br>
<br></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="header_msg_bg">
      <tr>
        <td align="center"><span class="txt_light">::</span> <span class="header_msg_txt"><strong> <?php echo $str['MISC_ACCESS_DENIED_ADMIN_TITLE'];?> </strong></span> <span class="txt_light">::</span></td>
      </tr>
      <tr>
        <td colspan="3" class="body_msg_bg" align="center"><br>
<?php echo $str['MISC_ACCESS_DENIED_ADMIN'];?><br><br>

</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="footer_main_bg_2"><span class="txt_light"><?php template_copyright();?></span></td>
  </tr>

  </tr>
</table>
<br>
</body>
</html>	
	
	<?php 
}


?>