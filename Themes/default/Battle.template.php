<?php
/*
 * Battle was developed for SMF forums c/o SA, nend & Underdog
 * Copyright 2009, 2010, 2011, 2012, 2013, 2014  SA | nend | Underdog
 * Revamped and supported by -Underdog-
 * This software package is distributed under the terms of its Creative Commons - Attribution No Derivatives License (by-nd) 3.0
 * http://creativecommons.org/licenses/by-nd/3.0/
 */
function template_battlemain_above()
{
	global $context, $txt, $modSettings, $scripturl, $settings, $user_info;

	// Dynamic battle favicon
	$favicon = $settings['images_url'] . '/battle/favicon.ico';
	echo '
	<script type="text/javascript"><!-- // --><![CDATA[
		window.onload = function()
		{
			var battle_ico = ', json_encode(iconv($context['character_set'], 'UTF-8', $favicon)), '
			var fileref = document.createElement("link");
			fileref.rel = "shortcut icon";
			fileref.href = battle_ico;
			fileref.type = "image/x-icon";
			document.getElementsByTagName("head")[0].appendChild(fileref);
		};
	// ]]></script>';

	if(empty($modSettings['enable_battle']))
		fatal_error($txt['battle_dis'], false);

	echo '
	<span class="clear upperframe"><span></span></span>
	<div class="roundframe">
		<div class="innerframe">
			<a id="battle_main"></a>
			<script type="text/javascript">
				window.onload = function () {document.getElementById("battle_main").scrollIntoView(true);}
			</script>
			<div class="cat_bar">
				<h3 class="catbg">
					<span>
						', (strlen($txt['battle_title_game']) > 70) ? substr($txt['battle_title_game'], 0, 67) . '...' : $txt['battle_title_game'], '
					</span>
					<span style="float:right;font-size:10px;font-style:italic;">
						<span style="position:relative;margin-right:15px;">',
							(!empty($_COOKIE['battle_start_time']) ? str_replace('&!%@#', $_COOKIE['battle_start_time'], $txt['battle_reset_timer']) : ''), '
						</span>',
						($context['battle_mode'] !== $txt['battle_infinity'] ? $txt['battle_goal'] . '&nbsp;': ''),
						$txt['battle_mode'], '&nbsp;', (!empty($context['battle_mode']) ? $context['battle_mode'] : $txt['battle_complete']), '
					</span>
				</h3>
			</div>
			<table width="100%" class="windowbg2" border="0" cellpadding="5">
				<tr>
					<td class="normaltext" width="20%" valign="top">
						<div class="title_bar">
							<h3 class="titlebg">
								<span>
									<img border="0" src="', $settings['images_url'], '/battle/world.png" alt="" />
									', !empty($modSettings['enable_img_menu']) ? $txt['battle_menu1'] : $txt['battle_menu2'], '
								</span>
							</h3>
						</div>
						<div align="left">';

	if($modSettings['enable_img_menu'])
		echo '
							<img border="0" src="',$settings['images_url'],'/battle/village.png" alt="" usemap="#town" />
							<map id="town" name="town">
								<area shape="rect" coords="60,80,96,102" href="', $scripturl, '?action=battle;sa=main;home;#battle_main" alt="', $txt['battle_home'], '" title="', $txt['battle_home'], '" />
								<area shape="rect" coords="100,5,110,32" href="', $scripturl, '?action=battle;sa=explore;home;#battle_main" alt="', $txt['battle_expl'], '" title="', $txt['battle_expl'], '" />
								<area shape="rect" coords="91,60,107,82" href="', $scripturl, '?action=battle;sa=battle;home;#battle_main" alt="', $txt['battle_tent'], '" title="', $txt['battle_tent'], '" />
								<area shape="rect" coords="34,10,65,29" href="', $scripturl, '?action=battle;sa=shop;home;#battle_main" alt="', $txt['battle_shops'], '" title="', $txt['battle_shops'], '" />
								<area shape="rect" coords="22,45,52,75"  href="', $scripturl, '?action=battle;sa=gy;home;#battle_main" alt="', $txt['battle_gy'], '" title="', $txt['battle_gy'], '" />
								<area shape="rect" coords="64,24,82,35"  href="', $scripturl, '?action=battle;sa=quest;home;#battle_main" alt="', $txt['battle_questss'], '" title="', $txt['battle_questss'], '" />
								<area shape="rect" coords="9,80,26,103"  href="', $scripturl, '?action=battle;sa=upgrade;home;#battle_main" alt="', $txt['battle_hosp'], '" title="', $txt['battle_hosp'], '" />
							</map>';
	else
	{
		echo '
							<div style="text-align: left">
								<img border="0" src="', $settings['images_url'], '/battle/door.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=main;home;#battle_main">
									', $txt['battle_home'], '
								</a>
							</div>
							<div style="text-align: left">
								<img border="0" src="',$settings['images_url'],'/battle/world.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=explore;home;#battle_main">
									', $txt['battle_expl'], '
								</a>
							</div>
							<div style="text-align: left">
								<img border="0" src="', $settings['images_url'], '/battle/cart.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=shop;home;#battle_main">
									', $txt['battle_shops'], '
								</a>
							</div>';
		if (!empty($modSettings['battle_enable_membattle']))
			echo '
							<div style="text-align: left">
								<img border="0" src="', $settings['images_url'], '/battle/bomb.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=battle;home;#battle_main">
									', $txt['battle_tent'], '
								</a>
							</div>';
		if (!empty($modSettings['battle_enable_quests']))
			echo '
							<div style="text-align: left">
								<img border="0" src="', $settings['images_url'], '/battle/book.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=quest;home;#battle_main">
									', $txt['battle_questss'], '
								</a>
							</div>';
		echo '
							<div style="text-align: left">
								<img border="0" src="', $settings['images_url'], '/battle/upgrade.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=upgrade;home;#battle_main">
									', $txt['battle_hosp'], '
								</a>
							</div>
							<div style="text-align: left">
								<img border="0" src="', $settings['images_url'], '/battle/bug.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=monsters;#battle_main">
									', $txt['battle_monsters'], '
								</a>
							</div>
							<div style="text-allign: left">
								<img border="0" src="', $settings['images_url'], '/battle/medal.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=leaders;#battle_main">
									', $txt['battle_leaders'], '
								</a>
							</div>';
		if (!empty($modSettings['battle_enable_quests']))
			echo '
							<div style="text-allign: left">
								<img border="0" src="', $settings['images_url'], '/battle/cmedal.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=cleaders;#battle_main">
									', $txt['battle_cleaders'], '
								</a>
							</div>';
		echo '
							<div style="text-allign: left">
								<img border="0" src="', $settings['images_url'], '/battle/bcrosette.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=leaderboard;#battle_main">
									', $txt['battle_game_leaderboard'], '
								</a>
							</div>
							<div style="text-allign: left">
								<img border="0" src="', $settings['images_url'], '/battle/chart_pie.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=stats;#battle_main">
									', $txt['battle_game_stats'], '
								</a>
							</div>
							<div style="text-align: left">
								<img border="0" src="', $settings['images_url'], '/battle/graveyard.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=gy;home;#battle_main">
									', $txt['battle_gy'], '
								</a>
							</div>
							<div style="text-allign: left">
								<img border="0" src="', $settings['images_url'], '/battle/bullet_wrench.png" alt="" />
								<a href="', $scripturl, '?action=battle;sa=settings;#battle_main">
									', $txt['battle_game_set'], '
								</a>

							</div>';
	}
	echo '
						</div>
						<br />';

	foreach (array(!empty($modSettings['battle_enable_quests']) ? '' : '<br />', !empty($modSettings['battle_enable_membattle']) ? '' : '<br />') as $break)
		echo $break;

	if($modSettings['enable_battle_shoutbox'])
	{
		// If they have permission to moderate the shoutbox, show the shoutbox with an Empty Shoutbox link.
		if (allowedTo('battle_shouts_mod'))
		{
			echo '
						<div class="title_bar">
							<h3 class="titlebg">
								<img border="0" src="', $settings['images_url'], '/battle/shout.png" alt="" />
								', $txt['battle_shoput'], ' |
								<a href="', $scripturl, '?action=admin;area=battle;sa=dshout;#battle_main">
									', $txt['battle_empty'], '
								</a>
								<br />
							</h3>
						</div>
						<a href="', $scripturl, '?action=battle;sa=shout;hist;#battle_main">
							<img border="0" src="', $settings['images_url'], '/battle/time.png" alt="X"  title="', $txt['battle_hist'], '" />
						</a>
						&nbsp;
						<div class="middletext" style="width: 100%; height: 200px; overflow: auto;">';
			foreach ($context['battle_shout'] as $row)
			{
				echo '
							<div style="margin: 4px;">
								<div style="border: dotted 1px; padding: 2px 4px 2px 4px;" class="windowbg2">';

				if(allowedTo('battle_shouts_mod'))
					echo '
									<a href="', $scripturl, '?action=battle;sa=shout;del=', $row['id_shout'], ';#battle_main">
										<img border="0" src="', $settings['images_url'], '/battle/cancel.png" alt="X" title="', $txt['battle_del'], '"/>
									</a>
									&nbsp;';

				echo '
									<a href="', $scripturl, '?action=profile;u=', $row['id_member'], '">
										<span style="color:', $row['online_color'], '">
											', $row['real_name'], '
										</span>
									</a>
									', timeformat($row['time']), '
								</div>
								<div style="padding: 4px;">
									', (wordwrap(parse_bbc(censorText($row['content'])), 34, "\n", true)), '
								</div>
							</div>';
			}
			echo '
						</div>';
			if(allowedTo('battle_shouts'))
				echo '
						<form accept-charset="', $context['character_set'], '" class="middletext" style="padding: 0; margin: 0; margin-top: 5px; text-align: center;" name="battle_shout" action="', $scripturl, '?action=battle;sa=shout;', (!empty($context['sub_action']) ? 'ca=' . $context['sub_action'] . ';' : ''), 'go;#battle_main" method="post">
							<input class="middletext" name="the_shout" style="width: 80%;" maxlength="255" />
							<input style="margin-top: 4px;" class="middletext" type="submit" name="', $txt['battle_s'], '" value ="', $txt['battle_shout_button'], '" />
						</form>';

			echo '
					</td>
					<td class="normaltext" valign="top">';
		}
		// Otherwise they are just a regular user, just show them the regular shoutbox.
		else
		{
			echo '
					<div class="title_bar">
						<h3 class="titlebg">
							<img border="0" src="', $settings['images_url'], '/battle/shout.png" alt="" />
							', $txt['battle_shoput'], '
						</h3>
					</div>
					<a href="', $scripturl, '?action=battle;sa=shout;hist;#battle_main">
						<img border="0" src="', $settings['images_url'], '/battle/time.png" alt="X" title="', $txt['battle_hist'], '" />
					</a>
					&nbsp;
					<div class="middletext" style="width: 100%; height: 200px; overflow: auto;">';

			foreach ($context['battle_shout'] as $row)
			{
				echo '
						<div style="margin: 4px;">
							<div style="border: dotted 1px; padding: 2px 4px 2px 4px;" class="windowbg2">';

				if (allowedTo('battle_shouts_mod'))
					echo '
								<a href="', $scripturl, '?action=battle;sa=shout;del=', $row['id_shout'], ';#battle_main">
									<img border="0" src="', $settings['images_url'], '/battle/cancel.png" alt="X" title="', $txt['battle_del'], '"/>
								</a>
								&nbsp;';

				echo '
								<a href="', $scripturl, '?action=profile;u=', $row['id_member'], '">
									<span style="color:', $row['online_color'], '">
										', $row['real_name'], '
									</span>
								</a>
								', timeformat($row['time']), '
							</div>
							<div style="padding: 4px;">
							', (wordwrap(parse_bbc(censorText($row['content'])), 34, "\n", true)), '
							</div>
						</div>';
			}
			echo '
					</div>';

			if (allowedTo('battle_shouts'))
				echo '
						<form accept-charset="', $context['character_set'], '" class="middletext" style="padding: 0; margin: 0; margin-top: 5px; text-align: center;" name="battle_shout" action="', $scripturl, '?action=battle;sa=shout;go;#battle_main" method="post">
							<input class="middletext" name="the_shout" style="width: 80%;" maxlength="255" />
							<input style="margin-top: 4px;" class="middletext" type="submit" name="', $txt['battle_s'], '" value ="', $txt['battle_shout_button'], '" />
						</form>';

			echo '
					</td>
					<td class="normaltext" valign="top">';

		}
	}
	else
	{
		echo '
						<div>
							&nbsp;
						</div>
					</td>
					<td class="normaltext" valign="top">';
	}

}

function template_battle_champs()
{
  global $context, $scripturl, $txt;

	echo '
			<div class="title_bar">
				<h3 class="titlebg centertext">
					<span>', $txt['battle_leaderboard'], '</span>
				</h3>
			</div>
			<table width="100%" border="0" cellspacing="1" cellpadding="1">
				<tr class="titlebg">
					<td width="20%" class="centertext titlebg" >
						<strong>', $txt['battle_mem'], '</strong>
					</td>
					<td width="20%" class="centertext titlebg" >
						<strong>', $txt['battle_who_slain'], '</strong>
					</td>
					<td width="7%" class="centertext titlebg" >
						<strong>', $txt['battle_champ_against'], '</strong>
					</td>
					<td width="7%" class="centertext titlebg" >
						<strong>', $txt['battle_champ_t'], '</strong>
					</td>
					<td width="17%" class="centertext titlebg" >
						<strong>', $txt['battle_chaml_l'], '</strong>
					</td>
				</tr>';

	foreach ($context['battle_champs'] as $key => $row)
	{
		$class = $key % 2 == 0 ? 'windowbg' : 'windowbg2';

		echo '
				<tr class="' . $class . '">
					<td class="centertext" width="20%">
						<a href="', $scripturl,  '?action=profile;u=', $row['id_member'], '">
							', $row['real_name'], '
						</a>
					</td>
					<td class="centertext" width="20%">
						', $row['who_slain'], '
					</td>
					<td class="centertext" width="7%">
						', $row['times_champ'], '
					</td>
					<td class="centertext" width="7%">
						', $row['mem_slays'], '
					</td>
					<td class="centertext" width="17%">
						', date('Y-m-d h:ia', $row['date']), '
					</td>
				</tr>';
	}
	echo '
				<tr class="titlebg">
					<td colspan="5" style="line-height:2px;">
						&nbsp;
					</td>
				</tr>
			</table>';

}

function template_battle_leaderboard()
{
  global $context, $scripturl, $txt;

	echo '
			<div class="title_bar">
				<h3 class="titlebg centertext">
					<span>', $txt['battle_leaderboard2'], '</span>
				</h3>
			</div>
			<table width="100%" border="0" cellspacing="1" cellpadding="1">
				<tr class="titlebg">
					<td width="25%" class="centertext titlebg" >
						<strong>', $txt['battle_mem'], '</strong>
					</td>
					<td width="25%" class="centertext titlebg" >
						<strong>', $txt['battle_title'], '</strong>
					</td>
					<td width="10%" class="centertext titlebg" >
						<strong>', $txt['battle_statsLvl'], '</strong>
					</td>
					<td width="20%" class="centertext titlebg" >
						<strong>', $txt['battle_lscore'], '</strong>
					</td>
					<td width="20%" class="centertext titlebg" >
						<strong>', $txt['battle_date'], '</strong>
					</td>
				</tr>';

	foreach ($context['battle_leaderboard'] as $key => $row)
	{
		$class = $key % 2 == 0 ? 'windowbg' : 'windowbg2';

		echo '
				<tr class="' . $class . '">
					<td class="centertext" width="25%">
						<a href="', $scripturl,  '?action=profile;u=', $row['id_member'], '">
							', $row['real_name'], '
						</a>
					</td>
					<td class="centertext" width="25%">
						', $row['battle_title'], '
					</td>
					<td class="centertext" width="10%">
						', $row['level'], '
					</td>
					<td class="centertext" width="20%">
						', $row['score'], '
					</td>
					<td class="centertext" width="20%">
						', $row['date'], '
					</td>
				</tr>';
	}
	echo '
				<tr class="titlebg">
					<td colspan="5" style="line-height:2px;">
						&nbsp;
					</td>
				</tr>
			</table>', $context['battle_display']['page'];

}

function template_battle_campaign_champs()
{
  global $context, $scripturl, $txt;

	echo '
			<div class="title_bar">
				<h3 class="titlebg centertext">
					<span>', $txt['battle_campaign_leaderboard'], '</span>
				</h3>
			</div>
			<table width="100%" border="0" cellspacing="1" cellpadding="1">
				<tr class="titlebg">
					<td width="20%" class="centertext titlebg" >
						<strong>', $txt['battle_campaign_lb_warrior'], '</strong>
					</td>
					<td width="20%" class="centertext titlebg" >
						<strong>', $txt['battle_campaign_lb_name'], '</strong>
					</td>
					<td width="7%" class="centertext titlebg" >
						<strong>', $txt['battle_campaign_lb_quests'], '</strong>
					</td>
					<td width="17%" class="centertext titlebg" >
						<strong>', $txt['battle_campaign_lb_date'], '</strong>
					</td>
					<td width="7%" class="centertext titlebg" >
						<strong>', $txt['battle_campaign_lb_score'], '</strong>
					</td>
				</tr>';

	foreach ($context['battle_campaign_champs'] as $key => $row)
	{
		$class = $key % 2 == 0 ? 'windowbg' : 'windowbg2';

		echo '
				<tr class="' . $class . '">
					<td width="20%">
						<a href="', $scripturl,  '?action=profile;u=', $row['id_member'], '">
							', $row['real_name'], '
						</a>
					</td>
					<td class="vertical-align:middle;position:relative;" width="20%">
						', $row['campaign_name'], '
					</td>
					<td class="centertext" width="7%">
						', $row['times_quests'], '
					</td>
					<td class="centertext" width="17%">
						', $row['date'], '
					</td>
					<td class="centertext" width="7%">
						', $row['mem_score'], '
					</td>
				</tr>';
	}
	echo '
				<tr class="titlebg">
					<td colspan="5" style="line-height:2px;">
						&nbsp;
					</td>
				</tr>
			</table>', $context['battle_display']['page'];

	if (!empty($context['battle_campaign_champs']))
	{
		echo '
			<div style="text-align:right;display:box;">
				<br />
				<select id="battleCleader" class="windowbg" name="battle_cleader" onchange="location = this.options[this.selectedIndex].value;return false;">
					<option ', empty($context['campaign_id']) ? 'selected="selected" ' : ' ', 'value="', $scripturl, '?action=battle;sa=cleaders;#battle_main">
						', $txt['battle_campaign_lb_overall'], '
					</option>';

		foreach ($context['camp_list'] as $campaign => $data)
		{
			if (empty($data['start_time']))
				continue;
			echo '
					<option ', ($context['campaign_id'] == $campaign && !empty($context['campaign_id']) ? 'selected="selected" ' : ' '), 'value="', $scripturl, '?action=battle;sa=cleaders;id_campaign=' , $campaign, ';#battle_main">
						', (strlen($data['campaign_name']) > 60 ? substr($data['campaign_name'], 0, 57) . '...' : $data['campaign_name']), '
					</option>';
		}

		echo '
				</select>
			</div>';
	}
}

function template_battlemain_below()
{
	global $context, $txt, $modSettings, $scripturl, $settings, $user_info;

	echo '
					<td class="normaltext" width="20%" valign="top">
						<div class="title_bar">
							<h3 class="titlebg">
								<span class="left"></span><span>
									<img border="0" src="',$settings['images_url'],'/battle/chart_pie.png" alt="" />
									', $txt['battle_stast'], '
								</span>
							</h3>
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="',$settings['images_url'],'/battle/bullet_wrench.png" alt="" />
							', $txt['battle_statsSP'], ': ', $user_info['stat_point'], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="',$settings['images_url'],'/battle/money.png" alt="" />
							', $txt['battle_gold'], ': ', $user_info[$modSettings['bcash']], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="',$settings['images_url'],'/battle/heart.png" alt="" />
							', $txt['battle_statsH'], ': ', $user_info['hp'], '/', $user_info['max_hp'], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="', $settings['images_url'], '/battle/speed.png" alt="" />
							', $txt['battle_statsEg'], ': ', $user_info['energy'], '/', $user_info['max_energy'], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="',$settings['images_url'],'/battle/star.png" alt="" />
							', $txt['battle_statsS'], ': ', $user_info['stamina'], '/', $user_info['max_stamina'], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="', $settings['images_url'], '/battle/bomb.png" alt="" />
							', $txt['battle_statsA'], ': ', $user_info['atk'], '/', $user_info['max_atk'], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="', $settings['images_url'], '/battle/shield.png" alt="" />
							', $txt['battle_statsD'], ': ', $user_info['def'], '/', $user_info['max_def'], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="', $settings['images_url'], '/battle/exp.png" alt="" />
							', $txt['battle_statsE'], ': ', $user_info['exp'], '/', $user_info['max_exp'], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="', $settings['images_url'], '/battle/rosette.png" alt="" />
							', $txt['battle_statsLvl'], ': ', $user_info['level'], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="', $settings['images_url'], '/battle/crosette.png" alt="" />
							', $txt['battle_statsP'], ': ', $user_info['battle_points'], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="', $settings['images_url'], '/battle/medal.png" alt="" />
							', $txt['battle_ms'], ': ', $user_info['mem_slays'], '
						</div>
						<div style="padding:3px 0px 0px 10px">
							<img border="0" src="', $settings['images_url'], '/battle/cmedal.png" alt="" />
							', $txt['battle_mos'], ': ', $user_info['mon_slays'], '
						</div>
						<br />';

	if($modSettings['enable_battle_hist'])
	{
		$px = 'height:200px;';
		if($modSettings['enable_img_menu'])
			$px = 'height:150px;';

		// Well if they can administrate Battle they can also see a Clear History link.
		if (allowedTo('admin_battle'))
			echo '
						<div class="title_bar">
							<h3 class="titlebg">
								<span class="left"></span>
								<span>
									<img border="0" src="', $settings['images_url'], '/battle/bomb.png" alt="" />
									', $txt['battle_hist'], ' |
									<a href="', $scripturl, '?action=admin;area=battle;sa=dhist">
										', $txt['battle_empty'], '
									</a>
								</span>
							</h3>
						</div>
						<div class="middletext" style="width: 100%; overflow: auto;' . $px . '">';
		// Otherwise they must just be a regular user - show the regular history (without the option to clear the history).
		else
			echo '
							<div class="title_bar">
								<h3 class="titlebg">
									<span class="left"></span>
									<span>
										<img border="0" src="', $settings['images_url'], '/battle/bomb.png" alt="" />
										', $txt['battle_hist'], '
									</span>
								</h3>
							</div>
							<div class="middletext" style="width: 100%; overflow: auto;'. $px .'">';

		foreach ($context['battle_hist'] as $row)
		{
			echo '
								<div style="margin: 4px;">
									<div style="border: dotted 1px; padding: 2px 4px 2px 4px;">';

			if(allowedTo('battle_shouts_mod'))
				echo '
										<a href="'.$scripturl.'?action=battle;sa=bhist;del='.$row['id_hist'].';#battle_main">
											<img border="0" src="', $settings['images_url'], '/battle/cancel.png" alt="X"  title="'.$txt['battle_del'].'" />
										</a>
										&nbsp;';

			echo '
										', timeformat($row['time']), '
									</div>
									<div style="padding: 4px;">
										', (wordwrap(parse_bbc(censorText($row['content'])), 34, "\n", true)), '
									</div>
								</div>';
		}

		echo '
							</div>';
	}

	echo '
				</tr>
			</table>
		</div>
	</div>
	<span class="lowerframe"><span></span></span>';

	if ($modSettings['enable_show_who_battle'])
		template_load_did_you_know();

	echo '
	<br />
	<div class="centertext" style="font-size:10px;">
		', $txt['battle'], ' ', $txt['battle_version'], ' ', $txt['battle_revision'], ' &copy; 2009 - 2014
		<a href="http://www.simplemachines.org/community/index.php?topic=323835.0">
			SA|nend|Underdog
		</a>
	</div>';

	if ($modSettings['battle_dev'] == 1)
		echo '
	<br />
	<div class="centertext">
		<strong>', $txt['battle_build_info'], '</strong>
		<br />
		', $txt['battle_build'], ': ', $modSettings['battle_build'], '
		<br />
		', $txt['battle_build_date'], ': ', $modSettings['battle_build_date'],'
	</div>
	<br />';

	echo $context['battle_ErrorBack']['change'];
}

function template_load_did_you_know()
{
	global $context, $txt, $modSettings, $scripturl, $settings, $user_info;

	echo '
	<br />
	<span class="clear upperframe"><span></span></span>
	<div class="roundframe">
		<div class="innerframe">
			<div class="cat_bar">
				<h3 class="catbg centertext">
					', $txt['battle_did_you9'], '
				</h3>
			</div>
			<span style="line-height:1px;">
				&nbsp;
			</span>
			<div class="title_bar">
				<h3 class="titlebg">
					<span>
					', $txt['battle_did_you'], '
					</span>
				</h3>
			</div>
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tr class="windowbg2">
					<td>
						', $txt['battle_did_you1'], ' <strong>', $context['tot_quest'], ' </strong>', $txt['battle_did_you_quest'], '
						<br />
						', $txt['battle_did_you2'], ' <strong>', $context['tot_mon'], '</strong> ', $txt['battle_did_you3'], '
						<br />
						', $txt['battle_did_you4'], ' <strong>', $context['tot_shop'], '</strong> ', $txt['battle_did_you5'], '
						<br />
						', $txt['battle_did_you10'], ' <strong>', $context['tot_grave'], '</strong> ', $txt['battle_did_you11'], '
						<br />
						', $txt['battle_did_you6'], ' <strong>', $context['mon_slays'], '</strong> ', $txt['battle_did_you7'], '
						<br />
						', $txt['battle_did_you6'], ' <strong>', $context['mem_slays'], ' </strong> ', $txt['battle_did_you8'], '
					</td>
				</tr>
			</table>
			<div class="title_bar">
				<h3 class="titlebg">
					<span>
						', $txt['battle_users_online'], '
					</span>
				</h3>
			</div>
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tr class="windowbg2">
					<td>
						<div id="battleOnline">
							', $context['battle_whos_online'], '
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<span class="lowerframe"><span></span></span>
	<script type="text/javascript"><!-- // --><![CDATA[
		window.onload = function()
		{
			var battle_online = ', json_encode(iconv($context['character_set'], 'UTF-8', $context['battle_whos_online'])), '
			document.getElementById("battleOnline").innerHTML = battle_online;
		};
	// ]]></script>';
}

function template_main()
{
	global $context, $txt, $modSettings, $scripturl, $settings, $user_info;
	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle'], '
			</span>
		</h3>
	</div>
	<table width="100%" cellspacing="0" class="centertext" cellpadding="0" border="0">
		<tr>
			<td>';

	if (!empty($context['user']['avatar']))
		echo '
				<p class="avatar">', $context['user']['avatar']['image'], '</p>';
	else
		echo '
				<img border="0" src="', $settings['images_url'], '/battle/online.gif" width="50" height="50" alt="', $user_info['name'], '" />';

	echo '
				<br />
				<br />
				<strong>', $txt['battle_welcome_warrior'], ', ', $user_info['name'], '! </strong>
				<br />
				', $txt['battle_welcome_warrier_intro'], '
				<br />
				<br />
				<img border="0" src="', $settings['images_url'], '/battle/help.png" alt="', $txt['battle_howto'], '" />
				<a href="', $scripturl, '?action=battle;sa=howto;#battle_main">
					', $txt['battle_howto'], '
				</a>
				&nbsp;
				<img border="0" src="', $settings['images_url'], '/battle/bug.png" alt="', $txt['battle_monsters'], '" />
				<a href="', $scripturl,'?action=battle;sa=monsters;#battle_main">
					', $txt['battle_monsters'], '
				</a>
				&nbsp;
				<img border="0" src="', $settings['images_url'], '/battle/chart_pie.png" alt="', $txt['battle_game_stats'], '" />
				<a href="', $scripturl, '?action=battle;sa=stats;#battle_main">
					', $txt['battle_game_stats'], '
				</a>
				&nbsp;
				<img border="0" src="', $settings['images_url'], '/battle/bullet_wrench.png" alt="', $txt['battle_game_set'], '" />
				<a href="', $scripturl, '?action=battle;sa=settings;#battle_main">
					', $txt['battle_game_set'], '
				</a>
				<br />
				<br />
			</td>
		</tr>';

	if (($user_info['exp'] >= $user_info['max_exp']) && $user_info['exp'] != 0)
		echo '
		<tr class="windowbg">
			<td class="centertext" colspan="2">
				', $txt['battle_levelnew2'], '
				<br />
				<br />
				<form action="', $scripturl, '?action=battle;sa=levelup;#battle_main" method="post">
					<input type="submit" value="', $txt['battle_levelnew2'], '" />
				</form>
			</td>
		</tr>';

	echo '
	</table>';

	if ($user_info['hp'] == 0)
		echo $txt['battle_deadplease'];
}

function template_battle_mem_set()
{
	global  $scripturl, $context, $user_info, $txt;
	echo '
	<div class="cat_bar">
		<h3 class="catbg">
			<span>
				', $txt['battle_game_set'], '
			</span>
		</h3>
	</div>
	<br /><br />
	<form action="', $scripturl, '?action=battle;sa=settings;save" method="post" accept-charset="', $context['character_set'], '">
		<table class="centertext">
			<tr>
				<td>
					<input type="checkbox" name="battle_pm" ', ($user_info['bpm'] ? ' checked="checked" ' : ''), ' />
				</td>
				<td style="float:left;">
					', $txt['battle_game_seta'], '
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="battle_only_buddies_shout" ', ($user_info['battle_only_buddies_shout'] ? ' checked="checked" ' : ''), ' style="padding:0;position:relative;" />
				</td>
				<td style="float:left;">
					', $txt['shoutbox_buddies_only'], '
				</td>
			</tr>
		</table>
		<br />
		<br />
		<div class="centertext">
			<input type="submit" name="submit" value="', $txt['save'], '" />
		</div>
	</form>';
}

function template_battle_stats()
{
	global  $scripturl, $settings, $context, $modSettings, $txt;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_game_stats'], '
			</span>
		</h3>
	</div>
	<table border="0" width="100%" class="centertext bordercolor" cellspacing="1" cellpadding="1">
		<tr>
			<td>
				<div class="cat_bar">
					<h3 class="catbg">
						<span>
							', $txt['battle_stats_attack'], '
						</span>
					</h3>
				</div>
			</td>
			<td>
				<div class="cat_bar">
					<h3 class="catbg">
						<span>
							', $txt['battle_stats_def'], '
						</span>
					</h3>
				</div>
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top">
				<table border="0" cellpadding="1" cellspacing="0" width="100%">';

	if (empty($context['top_atk']))
		echo '
					<tr>
						<td colspan="3" style="line-height:1px;">
							&nbsp;
						</td>
					</tr>';

	foreach ($context['top_atk'] as $key => $atk)
	{
		echo '
					<tr>
						<td width="60%" valign="top">
							<a href="', $scripturl, '?action=profile;u=', $atk['id_member'], '">
								', $atk['real_name'], '
							</a>
						</td>
						<td width="20%" align="left" valign="top">
							', $atk['atk'] > 0 ? '<img src="' . $settings['images_url'] . '/bar_stats.png" width="' . $atk['percent'] . '" height="15" alt="" />' : '&nbsp;', '
						</td>
						<td width="20%" align="right" valign="top">
							', $atk['atk'], '
						</td>
					</tr>';
	}
	echo '
				</table>
			</td>
			<td width="50%" valign="top">
				<table border="0" cellpadding="1" cellspacing="0" width="100%">';

	if (empty($context['top_def']))
		echo '
					<tr>
						<td colspan="3" style="line-height:1px;">
							&nbsp;
						</td>
					</tr>';

	foreach ($context['top_def'] as $def)
	{
		echo '
					<tr>
						<td width="60%" valign="top">
							<a href="', $scripturl, '?action=profile;u=', $def['id_member'], '">
								', $def['real_name'], '
							</a>
						</td>
						<td width="20%" align="left" valign="top">
							', $def['def'] > 0 ? '<img src="' . $settings['images_url'] . '/bar_stats.png" width="' . $def['percent'] . '" height="15" alt="" />' : '&nbsp;', '
						</td>
						<td width="20%" align="right" valign="top">
							', $def['def'], '
						</td>
					</tr>';
	}

	echo '
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<div class="cat_bar">
					<h3 class="catbg">
						<span>
							', $txt['battle_stats_mos'], '
						</span>
					</h3>
				</div>
			</td>
			<td>
				<div class="cat_bar">
					<h3 class="catbg">
						<span>
							', $txt['battle_stats_ms'], '
						</span>
					</h3>
				</div>
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top">
				<table border="0" cellpadding="1" cellspacing="0" width="100%">';

	if (empty($context['top_mos']))
		echo '
					<tr>
						<td colspan="3" style="line-height:1px;">
							&nbsp;
						</td>
					</tr>';

	foreach ($context['top_mos'] as $mos)
	{
		echo '
					<tr>
						<td width="60%" valign="top">
							<a href="', $scripturl, '?action=profile;u=', $mos['id_member'], '">
								', $mos['real_name'], '
							</a>
						</td>
						<td width="20%" align="left" valign="top">
							', $mos['mon_slays'] > 0 ? '<img src="' . $settings['images_url'] . '/bar_stats.png" width="' . $mos['percent'] . '" height="15" alt="" />' : '&nbsp;', '
						</td>
						<td width="20%" align="right" valign="top">
							', $mos['mon_slays'], '
						</td>
					</tr>';
	}

	echo '
				</table>
			</td>
			<td width="50%" valign="top">
				<table border="0" cellpadding="1" cellspacing="0" width="100%">';

	if (empty($context['top_ms']))
		echo '
					<tr>
						<td colspan="3" style="line-height:1px;">
							&nbsp;
						</td>
					</tr>';

	foreach ($context['top_ms'] as $ms)
	{
		echo '
					<tr>
						<td width="60%" valign="top">
							<a href="', $scripturl, '?action=profile;u=', $ms['id_member'], '">
								', $ms['real_name'], '
							</a>
						</td>
						<td width="20%" align="left" valign="top">
							', $ms['mem_slays'] > 0 ? '<img src="' . $settings['images_url'] . '/bar_stats.png" width="' . $ms['percent'] . '" height="15" alt="" />' : '&nbsp;', '
						</td>
						<td width="20%" align="right" valign="top">
							', $ms['mem_slays'], '
						</td>
					</tr>';
	}

	echo '
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<div class="cat_bar">
					<h3 class="catbg">
						<span>
							', $txt['battle_stats_gold'], '
						</span>
					</h3>
				</div>
			</td>
			<td>
				<div class="cat_bar">
					<h3 class="catbg">
						<span>
							', $txt['battle_stats_level'], '
						</span>
					</h3>
				</div>
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top">
				<table border="0" cellpadding="1" cellspacing="0" width="100%">';

	if (empty($context['top_gold']))
		echo '
					<tr>
						<td colspan="3" style="line-height:1px;">
							&nbsp;
						</td>
					</tr>';

	foreach ($context['top_gold'] as $gold)
	{
		echo '
					<tr>
						<td width="60%" valign="top">
							<a href="', $scripturl, '?action=profile;u=', $gold['id_member'], '">
								', $gold['real_name'], '
							</a>
						</td>
						<td width="20%" align="left" valign="top">
							', $gold[$modSettings['bcash']] > 0 ? '<img src="' . $settings['images_url'] . '/bar_stats.png" width="' . $gold['percent'] . '" height="15" alt="" />' : '&nbsp;', '
						</td>
						<td width="20%" align="right" valign="top">
							', $gold[$modSettings['bcash']], '
						</td>
					</tr>';
	}

	echo '
				</table>
			</td>
			<td width="50%" valign="top">
				<table border="0" cellpadding="1" cellspacing="0" width="100%">';

	if (empty($context['top_level']))
		echo '
					<tr>
						<td colspan="3" style="line-height:1px;">
							&nbsp;
						</td>
					</tr>';

	foreach ($context['top_level'] as $level)
	{
		echo '
					<tr>
						<td width="60%" valign="top">
							<a href="', $scripturl, '?action=profile;u=', $level['id_member'], '">
								', $level['real_name'], '
							</a>
						</td>
						<td width="20%" align="left" valign="top">
							', $level['level'] > 0 ? '<img src="' . $settings['images_url'] . '/bar_stats.png" width="' . $level['percent'] . '" height="15" alt="" />' : '&nbsp;', '
						</td>
						<td width="20%" align="right" valign="top">
							', $level['level'], '
						</td>
					</tr>';
	}

	echo '
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<div class="cat_bar">
					<h3 class="catbg">
						<span>
							', $txt['battle_stats_points'], '
						</span>
					</h3>
				</div>
			</td>
			<td>
				<div class="cat_bar">
					<h3 class="catbg">
						<span>
							', $txt['battle_stats_winner'], '
						</span>
					</h3>
				</div>
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top">
				<table border="0" cellpadding="1" cellspacing="0" width="100%">';

	if (empty($context['top_points']))
		echo '
					<tr>
						<td colspan="3" style="line-height:1px;">
							&nbsp;
						</td>
					</tr>';

	foreach ($context['top_points'] as $points)
	{
		echo '
					<tr>
						<td width="60%" valign="top">
							<a href="', $scripturl, '?action=profile;u=', $points['id_member'], '">
								', $points['real_name'], '
							</a>
						</td>
						<td width="20%" align="left" valign="top">
							', !empty($points['battle_points']) ? '<img src="' . $settings['images_url'] . '/bar_stats.png" width="' . ((int)$points['percent'] < 101 ? $points['percent'] : '100') . '" height="15" alt="" />' : '&nbsp;', '
						</td>
						<td width="20%" align="right" valign="top">
							', $points['total'], '
						</td>
					</tr>';
	}

	echo '
				</table>
			</td>
			<td width="50%" valign="top">
				<table border="0" cellpadding="3" cellspacing="0" width="100%">';

	if (empty($context['battle_winner']) && !empty($modSettings['battle_points']))
		echo '
					<tr>
						<td colspan="3" style="line-height:1px;">
							', $txt['battle_in_progress'], '
						</td>
					</tr>';
	elseif (empty($context['battle_winner']))
		echo '
					<tr>
						<td colspan="3" style="line-height:1px;">
							', $txt['battle_mode_disabled'], '
						</td>
					</tr>';
	else
	{
		echo '
					<tr>
						<td colspan="3" style="text-align:left;">
							<a href="', $scripturl, '?action=profile;u=', $context['battle_winner']['id'], '">
								', $context['battle_winner']['name'], '
							</a>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:left;">
							', $txt['battle_tally_points'], '
						</td>
						<td style="text-align:right;">
							', $context['battle_winner']['points'], '
						</td>
					</tr>';

		if (!empty($context['battle_winner']['camp_points']))
			echo '
					<tr>
						<td colspan="2" style="text-align:left;">
							', $txt['battle_camp_points'], '
						</td>
						<td style="text-align:right;">
							', $context['battle_winner']['camp_points'], '
						</td>
					</tr>';
		echo '
					<tr>
						<td colspan="2" style="text-align:left;">
							', $txt['battle_statsL'], '
						</td>
						<td style="text-align:right;">
							', $context['battle_winner']['level'], '
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:left;">
							', $txt['battle_statsHP'], '
						</td>
						<td style="text-align:right;">
							', $context['battle_winner']['hp'], '
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:left;">
							', $txt['battle_statsA'], '
						</td>
						<td style="text-align:right;">
							', $context['battle_winner']['atk'], '
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:left;">
							', $txt['battle_statsD'], '
						</td>
						<td style="text-align:right;">
							', $context['battle_winner']['def'], '
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:left;">
							', $txt['battle_statsE'], '
						</td>
						<td style="text-align:right;">
							', $context['battle_winner']['exp'], '
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:left;">
							', $txt['battle_statsMem'], '
						</td>
						<td style="text-align:right;">
							', $context['battle_winner']['mem_slays'], '
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:left;">
							', $txt['battle_statsMon'], '
						</td>
						<td style="text-align:right;">
							', $context['battle_winner']['mon_slays'], '
						</td>
					</tr>';
	}

	echo '
				</table>
			</td>
		</tr>
	</table>';
}

function battle_return()
{
	global $scripturl, $txt;

	echo '
	<br />
	<form action="', $scripturl, '?action=battle;sa=shop;home;#battle_main" method="post">
		<input type="submit" value ="', $txt['battle_visit_shop'], '" />
	</form>
	', $txt['battle_or'], '
	<br />
	<form action="', $scripturl, '?action=battle;#battle_main" method="post">
		<input type="submit" value ="', $txt['battle_return_home'], '" />
	</form>';
}

function template_howto()
{
	global  $scripturl, $txt;
	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_help'], '
			</span>
		</h3>
	</div>
	', $txt['battle_intro_text'], '
	<br />
	<br />
	', $txt['battle_intro_text1'];
}

function template_battle_stat_up()
{
	global $txt, $scripturl, $settings, $sc, $user_info;
	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_upgrade_ce'], '
			</span>
		</h3>
	</div>';

	if(!empty($_GET['done']))
	{
		if ($user_info['stat_point'] < 0)
			fatal_error($txt['battle_upcheat'], false);

		echo '
	<div class="centertext">
		', $txt['battle_upgrade_suc'], '
	</div>';

		if ((!empty($_SESSION['done'])) && $_SESSION['done'] == 1)
			fatal_error($txt['battle_upcheat'], false);

	}

	if(empty($user_info['stat_point']))
		echo $txt['battle_upgrade_stn'];
	else
		echo '
	<div class="centertext" style="font-weight:bold;">
		', $txt['battle_stuh'], $user_info['stat_point'], '&nbsp;', $txt['battle_syusp'], '
	</div>';

	echo '
	<div style="margin-bottom:2em;margin-top:1em;">
		<img border="0" src="', $settings['images_url'], '/battle/bomb.png" alt="" />
		', $txt['battle_matk'], '
		<span style="float:right;width:50%;">';

	if($user_info['stat_point'] > 0)
		echo '
			<a href="'. $scripturl. '?action=battle;sa=upgrade;max_atk;sesc=', $sc, '">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if (($user_info['stat_point'] >= 5) && $user_info['stat_point'] != 0)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_atk5;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add5.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if ($user_info['stat_point'] >= 50)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_atk50;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add50.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if ($user_info['stat_point'] >= 500)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_atk100;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add100.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if($user_info['stat_point'] < 1)
		echo '
			<img border="0" src="', $settings['images_url'], '/battle/delete.png" alt="', $txt['battle_no_stats_p'], '" />';

	echo '
		', $user_info['max_atk'], '
		</span>
		<ul style="list-style-type: circle;line-height:1px;">
			<li>', $txt['battle_upd'], '</li>
		</ul>
	</div>
	<div style="margin-bottom:2em;">
		<img border="0" src="', $settings['images_url'], '/battle/speed.png" alt="" />
		', $txt['battle_energy'], '
		<span style="float:right;width:50%;">';

	if($user_info['stat_point'] > 0)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_energy;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if (($user_info['stat_point'] >= 5) && $user_info['stat_point'] != 0)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_energy5;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add5.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if ($user_info['stat_point'] >= 50)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_energy50;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add50.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if ($user_info['stat_point'] >= 500)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_energy100;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add100.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if($user_info['stat_point'] < 1)
		echo '
			<img border="0" src="', $settings['images_url'], '/battle/delete.png" alt="', $txt['battle_no_stats_p'], '" />';

	echo '
		', $user_info['max_energy'], '
		</span>
		<ul style="list-style-type: circle;line-height:1px;">
			<li>', $txt['battle_upd1'], '</li>
		</ul>
	</div>
	<div style="margin-bottom:2em;">
		<img border="0" src="', $settings['images_url'], '/battle/star.png" alt="" />
		', $txt['battle_Stamina'], '
		<span style="float:right;width:50%;">';

	if($user_info['stat_point'] > 0)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_stamina;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if (($user_info['stat_point'] >= 5) && $user_info['stat_point'] != 0)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_stamina5;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add5.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if ($user_info['stat_point'] >= 50)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_stamina50;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add50.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if ($user_info['stat_point'] >= 500)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_stamina100;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add100.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if($user_info['stat_point'] < 1)
		echo '
			<img border="0" src="', $settings['images_url'], '/battle/delete.png" alt="', $txt['battle_no_stats_p'], '" />';

	echo '
		', $user_info['max_stamina'], '
		</span>
		<ul style="list-style-type: circle;line-height:1px;">
			<li>', $txt['battle_upd2'], '</li>
		</ul>
	</div>
	<div style="margin-bottom:2em;">
		<img border="0" src="', $settings['images_url'], '/battle/shield.png" alt="" />
		', $txt['battle_def'], '
		<span style="float:right;width:50%;">';

	if($user_info['stat_point'] > 0)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_def;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if (($user_info['stat_point'] >= 5) && $user_info['stat_point'] != 0)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_def5;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add5.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';
	if ($user_info['stat_point'] >= 50)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_def50;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add50.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if ($user_info['stat_point'] >= 500)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_def100;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add100.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if($user_info['stat_point'] < 1)
		echo '
			<img border="0" src="', $settings['images_url'], '/battle/delete.png" alt="', $txt['battle_no_stats_p'], '" />';

	echo '
		', $user_info['max_def'], '
		</span>
		<ul style="list-style-type: circle;line-height:1px;">
			<li>', $txt['battle_upd3'], '</li>
		</ul>
	</div>
	<div style="margin-bottom:2em;">
		<img border="0" src="', $settings['images_url'], '/battle/heart.png" alt="" />
		', $txt['battle_mhp'], '
		<span style="float:right;width:50%;">';

	if($user_info['stat_point'] > 0)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_hp;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if ($user_info['stat_point'] >= 5)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_hp5;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add5.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if ($user_info['stat_point'] >= 50)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_hp50;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add50.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if ($user_info['stat_point'] >= 500)
		echo '
			<a href="', $scripturl, '?action=battle;sa=upgrade;max_hp100;sesc=', $sc, ';#battle_main">
				<img style="width:18px;height:18px;border:0px;vertical-align:bottom;" src="', $settings['images_url'], '/battle/add100.png" alt="', $txt['battle_yes_stats_p'], '" />
			</a>';

	if($user_info['stat_point'] < 1)
		echo '
			<img border="0" src="', $settings['images_url'], '/battle/delete.png" alt="', $txt['battle_no_stats_p'], '" />';

	echo '
		', $user_info['max_hp'], '
		</span>
		<ul style="list-style-type: circle;line-height:1px;">
			<li>', $txt['battle_upd4'], '</li>
		</ul>
	</div>';
}

function template_battle_search()
{
	global $context, $settings, $scripturl, $txt, $user_info, $modSettings;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_expl'], '
			</span>
		</h3>
	</div>';

	foreach ($context['battle_explore'] as $row)
	{
		if(!empty($_GET['open']))
		{
			$num = !empty($_GET['open']) ? $_GET['open'] : 0;

			if (!empty($context['battleExplore']['customAction']))
				echo '
	<div class="centertext">
		', $context['battleExplore']['customAction'], '
		<br />
		<br />
		<form action="', $scripturl, '?action=battle;sa=explore;home;#battle_main" method="post">
			<input type="submit" value ="', $txt['battle_back'], '" />
		</form>
	</div>';
		}
		else
		{
			// battle or explore action that is the question
			if (!empty($context['isbattle_action']))
			{
				// Explore action
				echo '
		', $row['start'], '
	<br />
	<br />
	<div class="centertext">
		<form action="', $scripturl, '?action=battle;sa=search;open=', $row['id_explore'], ';session=', $context['session_id'], $context['battle']['customSessionId'], ';home;#battle_main" method="post">
			<input type="submit" value ="', $txt['battle_ok'], '" />
		</form>
		', $txt['battle_or'], '
		<br />
		<form action="', $scripturl, '?action=battle;sa=explore;home;#battle_main" method="post">
			<input type="submit" value ="', $txt['battle_no'], '" />
		</form>
	</div>';
			}
			else
			{
				// Well it is not explore action, it has to be a MONSTER!!
				echo '
	<div class="centertext">
		', $txt['battle_you_in_mon'], '
		<br />
		<br />
		', $row['name'], '
		<br />
		<br />
		<img name="icon" src="', $settings['images_url'], '/battle/monsters/', $row['img'],'" alt="" />
		<br />
		<img border="0" src="',$settings['images_url'],'/battle/bomb.png" alt="" />
		', $txt['battle_atk'], '=', $row['atk'], '&nbsp;&nbsp;', '
		<img border="0" src="', $settings['images_url'], '/battle/shield.png" alt="" />
		&nbsp;', $txt['battle_def'], '=', $row['def'];

				if ($user_info['level'] < $row['mon_range'] || $user_info['level'] > $row['mon_max_range'])
					echo '
		<br />', $txt['battle_not_range'], '<br />';

				if (isset($context['battle']['firstatk']))
				{
					// Well did the monster attack first?
					echo '
		<br />', $row['name'], '&nbsp;', $txt['battle_game_mcog'], '&nbsp;', $context['battle']['firstatk'], '&nbsp;', $txt['battle_hist10'];

					if (!empty($context['battle']['firstdead']))
					{
						// I guess they did attack first and killed you.
						echo '<br />', $txt['battle_game_mcog1'], '<br />', battle_return();
					}

					echo '
		<br />';
				}

				// Attack or run away?
				if (empty($context['battle']['firstdead']) && ($user_info['hp'] < 21 && $user_info['hp'] > 0) || $user_info['hp'] < $user_info['max_hp']/20 && empty($context['battle']['firstdead']))
					echo '
		<br />
		<div class="centertext">
			', $txt['battle_hp_low'], ' ~ ', $txt['battle_return_shop'], '
		</div>';
				if (empty($context['battle']['firstdead']))
					echo '
		<br />
		<br />
		<form action="', $scripturl, '?action=battle;sa=explore;#battle_main" method="post">
			<input type="submit" value ="', $txt['battle_run'], '" />
		</form>
		', $txt['battle_or'], '
		<br />
		<form action="', $scripturl, '?action=battle;sa=fm;mon=', $row['id_monster'], ';session=', $context['session_id'], $context['battle']['checkSession'], ';#battle_main" method="post">
			<input type="submit" value ="', $txt['battle_atk'], '" />
		</form>';

				echo '
	</div>';
			}
		}
	}
}

function template_fmon()
{
	global $context, $settings, $scripturl, $attack_id, $txt, $user_info;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_expl'], '
			</span>
		</h3>
	</div>';

	// Attack again or run away?
	if(!empty($_GET['run']))
		echo '
	<div class="centertext">
		', (!empty($context['battle_message2']) ? $context['battle_message2'] : ''), '
	</div>
	<br />
	<br />
	<div class="centertext">
		<form action="', $scripturl, '?action=battle;sa=battle;sa=fm;run;mon=', $_GET['mon'], ';home;#battle_main" method="post">
			<input type="submit" value ="', $txt['battle_run'], '" />
		</form>
		', $txt['battle_or'], '<br />
		<form action="', $scripturl, '?action=battle;sa=battle;sa=fm;mon=', $_GET['mon'], ';home;#battle_main" method="post">
			<input type="submit" value ="', $txt['battle_ex_atk_again'], '" />
		</form>
	</div>';

	else
		echo '
		<div class="centertext">
			', (!empty($context['battle_message']) ? $context['battle_message'] : ''), '
		</div>';
}

function template_battle_shop()
{
	global $context, $txt, $act, $scripturl, $sc, $modSettings, $settings, $user_info;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_shop2'], '
			</span>
		</h3>
	</div>';

	if(!empty($_GET['done']))
		echo '
	<div class="centertext">
		', $txt['battle_shop_suc'], '
	</div>';

	echo '
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td class="centertext titlebg" style="font-weight:bold;width:25%;">
				', $txt['battle_shop_Item'], '
			</td>
			<td class="centertext titlebg" style="font-weight:bold;width:15%;">
				', $txt['battle_shop_Price'], '
			</td>
			<td class="centertext titlebg" style="font-weight:bold;width:30%;">
				', $txt['battle_shop_description'], '
			</td>
			<td class="centertext titlebg" style="font-weight:bold;width:30%;">
				', $txt['battle_action'], '
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="4">';

	foreach ($context['shop'] as $key => $row)
	{
		$class = $key % 2 == 0 ? 'windowbg' : 'windowbg2';
		echo '
		<tr>
			<td align="left" style="width:25%;" class="' . $class . '">
				<img style="position:relative;vertical-align:middle;" border="0" src="', $settings['images_url'], '/battle/shop/', $row['img'], '" alt="X"  title="', $row['name'], '" />
				<span style="position:relative;vertical-align:middle;">
					&nbsp;', $row['name'], '
				</span>
			</td>
			<td class="centertext ', $class, '" style="width:15%;">
				', $row['price'], '
			</td>
			<td class="centertext ', $class, '" style="width:30%;">
				', $row['description'], '
			</td>
			<td class="centertext ', $class, '" style="width:30%;">';

		if($user_info[$row['action']] >= $user_info['max_'.$row['action'].''])
		{
			if($row['action'] == 'atk')
				$act = $txt['battle_atk'];
			elseif($row['action'] == 'def')
				$act = $txt['battle_def'];
			elseif($row['action'] == 'stamina')
				$act = $txt['battle_Stamina'];
			elseif($row['action'] == 'energy')
				$act = $txt['battle_energy'];
			elseif($row['action'] == 'hp')
				$act = $txt['battle_hp'];
			else
				$act = false;

			echo $txt['battle_shop_all_have'], $act;

		}
		else
		{
			if($row['price'] > $user_info[$modSettings['bcash']])
				echo $txt['battle_shop_not_gold'];
			else
				echo '
				<form action="',$scripturl,'?action=battle;sa=shop;buy=', $row['id_item'], ';sesc=', $sc, ';#battle_main" method="post">
					', $txt['bshop_amount'], ':&nbsp;
					<input type="text" name="pamount" size="10" value="1" />
					<input type="hidden" name="sc" value="', $sc, '" />
					<input type="submit" value="', $txt['battle_shop_buynow'], '" />
				</form>';
		}

		echo '
			</td>
		</tr>';
	}

	echo '
		<tr class="catbg">
			<td style="font-weight:bold;line-height:3px;" colspan="4">
				&nbsp;
			</td>
		</tr>
	</table>', $context['battle_display']['page'];

}

function template_battle_fight()
{
	global $context, $txt;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_mem'], '
			</span>
		</h3>
	</div>';

	if (isset($context['battle_message']))
		echo $context['battle_message'];
}

function template_battle_quest_final()
{
	global $context, $txt;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_quest_final_complete'], '
			</span>
		</h3>
	</div>';

	if (isset($context['battle_message']))
		echo '
	<br /><div style="font-family:Comic Sans MS;">', $context['battle_message'], '</div>';

	echo '
	<br /><div style="font-weight:bold;">', str_replace('&%#@!$', 'current_page=' . $context['current_page'] . ';' . (!empty($context['campaigns_id']) ? 'id_campaign=' . $context['campaigns_id'] . ';' : ''), $txt['battle_return_quest']), '</div>';
}

function template_battle_quest_incomplete()
{
	global $context, $txt;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_Quest'], '
			</span>
		</h3>
	</div>';

	if (isset($context['battle_message']))
		echo '
	<br /><div style="font-family:Comic Sans MS;">', $context['battle_message'], '</div>';

	echo '
	<br /><div style="font-weight:bold;">', str_replace('&%#@!$', 'current_page=' . $context['current_page'] . ';' . (!empty($context['campaigns_id']) ? 'id_campaign=' . $context['campaigns_id'] . ';' : ''), $txt['battle_return_quest']), '</div>';
}

function template_battle_battle()
{
	global $context, $txt, $scripturl, $boardurl, $settings, $user_info, $modSettings;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				<a href="', $scripturl, '?action=battle;sa=battle;home;sort=id_member;order=', $context['battle_mem_order'], ';#battle_main">
					', $txt['battle_mem'], '
				</a>
			</span>
			<span style="vertical-align:middle;position:relative;float:right;top:25%;display: table-cell;">
				<a style="text-decoration: none;" href="', $scripturl, '?action=battle;sa=battle;home;sort=', $context['battle_mem_sort'], ';order=', ($context['battle_mem_order'] === 'ASC' ? 'DESC' : 'ASC'), ';#battle_main" title="', $txt['battle_list_order'], '">
					<img style="position:relative;vertical-align:middle;" src="', $settings['default_theme_url'], '/images/battle/battle-sort_dir.gif" alt="+/-" />
				</a>
			</span>
		</h3>
	</div>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="15%" class="centertext titlebg" style="font-weight:bold;">
				<a href="', $scripturl, '?action=battle;sa=battle;home;sort=real_name;order=', $context['battle_mem_order'], ';#battle_main">
					', $txt['battle_memb'], '
				</a>
			</td>
			<td width="15%" class="centertext titlebg" style="font-weight:bold;">
				<a href="', $scripturl, '?action=battle;sa=battle;home;sort=hp;order=', $context['battle_mem_order'], ';#battle_main">
					', $txt['battle_hp'], '
				</a>
			</td>
			<td width="15%" class="centertext titlebg" style="font-weight:bold;">
				<a href="', $scripturl, '?action=battle;sa=battle;home;sort=atk;order=', $context['battle_mem_order'], ';#battle_main">
					', $txt['battle_atk'], '
				</a>
			</td>
			<td width="15%" class="centertext titlebg" style="font-weight:bold;">
				<a href="', $scripturl, '?action=battle;sa=battle;home;sort=def;order=', $context['battle_mem_order'], ';#battle_main">
					', $txt['battle_def'], '
				</a>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="4">';

	foreach ($context['atk'] as $key => $row)
	{
		$class = $key % 2 == 0 ? 'windowbg' : 'windowbg2';
		echo '
		<tr>
			<td class="centertext ', $class, '" width="25%">
				', $avatar = $row['avatar'] == '' ? ($row['id_attach'] > 0 ? '<img src="' . (empty($row['attachment_type']) ? $boardurl . '?action=dlattach;attach=' . $row['id_attach'] . ';type=avatar' : $modSettings['custom_avatar_url'] . '/' . $row['filename']) . '" alt="" width="25" height="25" style="border: 1px solid silver"/>' : '') : (stristr($row['avatar'], 'http://') ? '<img src="' . $row['avatar'] . '" alt="" class="avatar" width="25" height="25" style="border: 1px solid silver"/>' : '<img src="avatars/' . htmlspecialchars($row['avatar']) . '" alt="" class="avatar" width="25" height="25" style="border: 1px solid silver"/>');

		if(empty($avatar))
			echo '
				<img border="0" src="', $settings['images_url'], '/battle/online.gif" width="25" height="25" alt="" />';

		echo '
				<br />
				<a href="', $scripturl, '?action=profile;u=', $row['id_member'], '" title="', $row['real_name'], '">
					<span style="color:', $row['online_color'], '">
						', strlen($row['real_name']) > 18 ? substr($row['real_name'], 0, 15) . '...' : $row['real_name'], '
					</span>
				</a>
				<br />
				<a href="', $scripturl, '?action=battle;sa=fight;attack=', $row['id_member'], ';session=', $context['session_id'], $context['battle_checkSession'], ';#battle_main">
					', $txt['battle_atk'], '
				</a>
			</td>
			<td class="centertext ', $class, '" width="25%">
				', $row['hp'], '
			</td>
			<td class="centertext ', $class, '" width="25%">
				', $row['atk'], '
			</td>
			<td class="centertext ', $class, '" width="25%">
				', $row['def'], '
			</td>
		</tr>';
	}

	echo '
		<tr class="catbg">
			<td style="font-weight:bold;line-height:3px;" colspan="4">
				&nbsp;
			</td>
		</tr>
	</table>', $context['battle_display']['page'];

	if ($user_info['hp'] == 0)
		echo $txt['battle_deadplease'];
}

function template_battle_quest()
{
	global $context, $txt, $user_info, $scripturl;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_questss'], '
			</span>
		</h3>
	</div>';

	if(isset($_GET['go']))
		echo '
	<div class="centertext">
		', $context['quest'], '
	</div>
	<br />
	 <form action="', $scripturl, '?action=battle;sa=quest;home;current_page=', $context['current_page'], ';', (!empty($context['campaigns_id']) ? 'id_campaign=' . $context['campaigns_id'] . ';' : ''), '#battle_main" method="post">
	         <input type="submit" value ="', $txt['battle_back'], '" />
         </form>';
	elseif(isset($_GET['do']))
	{
		echo '
	<div class="centertext">
		', $context['quest2'], '
		<br />
		<br />
			', (isset($context['quest3']) ? $context['quest3'] : ''), '
	</div>
	', $context['battle_message'];
	}
	else
	{
		echo '
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td class="centertext titlebg" style="font-weight:bold;width:21%;">
				', $txt['battle_quest_name'], '
			</td>
			<td class="centertext titlebg" style="font-weight:bold;width:12%;">
				', $txt['battle_quest_lvl'], '
			</td>
			<td class="centertext titlebg" style="font-weight:bold;width:12%;">
				', $txt['battle_quest_energy'], '
			</td>
			<td class="centertext titlebg" style="font-weight:bold;width:12%;">
				', $txt['battle_quest_play'], '
			</td>
			<td class="centertext titlebg" style="font-weight:bold;width:21%;">
				', $txt['battle_quest_type'], '
			</td>
			<td class="centertext titlebg" style="font-weight:bold;width:22%;">
				', $txt['battle_quest_action'], '
			</td>
	</table>';

		if (empty($context['battle_quest']))
			echo '
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td class="centertext windowbg" style="width:21%;vertical-align:middle;font-weight:bold;">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="centertext windowbg" style="width:21%;vertical-align:middle;font-weight:bold;">
				', $txt['battle_qno'], '
			</td>
		</tr>';
		else
		{
			echo '
	<table width="100%" border="0" cellspacing="1" cellpadding="1">';

			foreach ($context['battle_quest'] as $key => $row)
			{
				$x = empty($x) ? $x=1 : $x+1;
				$class = $x % 2 == 0 ? 'windowbg' : 'windowbg2';
				echo '
		<tr>
			<td class="centertext ', $class, '" style="width:21%;vertical-align:middle;">
				<span style="top:-2px;position:relative;">
					', $row['name'], '
				</span>';
				if (substr($row['campaign_img'], -1) !== '/' && !empty($row['campaign_img']))
					echo '
				<br />
				<span style="top:3px;position:relative;">
					<a href="', $scripturl, '?action=battle;sa=cleaders;id_campaign=', $row['campaign_id'] ,';#battle_main" title="', $row['campaign_name'], ' ', $txt['battle_leaderboard_ctitle'], '">
						<img src="', $row['campaign_img'], '" alt="', $row['campaign_name'],'" style="height:20px;width:20px;" />
					</a>
				</span>
				<br />
				<span style="top:5px;position:relative;">
				', $row['status'], '
				</span>';
				elseif ($row['campaign_name'])
					echo '
				<br />
				<span style="top:3px;position:relative;">
					<a href="', $scripturl, '?action=battle;sa=cleaders;id_campaign=', $row['campaign_id'] ,';#battle_main" title="', $row['campaign_name'], ' ', $txt['battle_leaderboard_ctitle'], '">
						', $row['campaign_name'], '
					</a>
				</span>
				<br />
				<span style="top:5px;position:relative;">
				', $row['status'], '
				</span>';

				echo '
			</td>
			<td class="centertext ', $class, '" style="width:12%;">
				', $row['level'], '
			</td>
			<td class="centertext ', $class, '" style="width:12%;">
				', $row['energy'], '
			</td>
			<td class="centertext ', $class, '" style="width:12%;">
				', $row['plays'], '
			</td>
			<td class="centertext ', $class, '" style="width:21%;">
				', $row['finalText'], '
			</td>
			<td class="centertext ', $class, '" style="position:relative;line-height:25px;width:22%;">
				<span style="position:relative;line-height:2em;">
				', $row['display'], '
				</span>
			</td>
		</tr>
		</tr>
		<tr>
			<td colspan="6">
				<hr />
			</td>
		</tr>';
			}

		}

		echo '
		<tr class="catbg">
			<td style="font-weight:bold;line-height:3px;width:100%;" colspan="6">
				&nbsp;
			</td>
		</tr>
	</table>', $context['battle_display']['page'];

		if (!empty($context['camp_list']))
		{
			echo '
			<div style="text-align:right;display:box;">
				<br />
				<select id="battleCleader" class="windowbg" name="battle_cleader" onchange="location = this.options[this.selectedIndex].value;return false;">
					<option ', empty($context['campaign_id']) ? 'selected="selected" ' : ' ', 'value="', $scripturl, '?action=battle;sa=quest;home;#battle_main">
						', $txt['battle_campaign_lb_overall'], '
					</option>';

			foreach ($context['camp_list'] as $campaign => $data)
			{
				if (empty($data['campaign_name']))
					continue;

				echo '
					<option ', ($context['campaigns_id'] == $campaign && !empty($context['campaigns_id']) ? 'selected="selected" ' : ' '), 'value="', $scripturl, '?action=battle;sa=quest;id_campaign=' , $campaign, ';home;#battle_main">
						', (strlen($data['campaign_name']) > 60 ? substr($data['campaign_name'], 0, 57) . '...' : $data['campaign_name']), '
					</option>';
			}

			echo '
				</select>
			</div>';
		}
	}

	echo $context['battleNoBattle'];
}

function template_battle_grave()
{
	global $context, $txt, $scripturl, $modSettings;
	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_gy'], '
			</span>
		</h3>
	</div>';

	if(!empty($_GET['done']))
		echo '
	<div class="centertext">
		', $txt['battle_heal_suc'], '
	</div>';

	echo '
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td class="centertext titlebg" style="font-weight:bold;width:33%;">
				', $txt['battle_mem'], '
			</td>
			<td class="centertext titlebg" style="font-weight:bold;width:33%;">
				', $txt['battle_date'], '
			</td>
			<td class="centertext titlebg" style="font-weight:bold;width:33%;">
				', $txt['battle_rfp'], '
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="4">';

	foreach ($context['battle_grave'] as $row)
	{
		echo '
		<tr>
			<td class="centertext windowbg" style="width:33%;">
				<a href="', $scripturl, '?action=profile;u=', $row['id_memdef'], '">
					<span style="color:', $row['online_color'], '">
						', $row['real_name'], '
					</span>
				</a>
			</td>
			<td class="centertext windowbg2" style="width:33%;">
				', timeformat($row['date']), '
			</td>
			<td class="centertext windowbg" style="width:33%;">
				<a href="', $scripturl.'?action=battle;sa=hosp;heal2=', $row['id_memdef'], '">
					', $modSettings['battle_how_much_reviv_user'], '&nbsp;', $txt['battle_gold'], '
				</a>
			</td>
		</tr>';
	}

	echo '
		<tr class="catbg">
			<td colspan="3" style="font-weight:bold;line-height:3px;">
				&nbsp;
			</td>
		</tr>
	</table>', $context['battle_display']['page'];
}

function template_battle_shout()
{
	global $context, $txt, $settings, $scripturl;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_shout'], '
			</span>
		</h3>
	</div>';

	foreach ($context['battle_shout_hist'] as $row)
	{
		echo '
	<div style="margin: 4px;">
		<div style="border: dotted 1px; padding: 2px 4px 2px 4px;" class="windowbg2">';

		if(allowedTo('battle_shouts_mod'))
			echo '
			<a href="', $scripturl, '?action=battle;sa=shout;del=', $row['id_shout'], ';#battle_main">
				<img border="0" src="', $settings['images_url'], '/battle/cancel.png" alt="X" title="', $txt['battle_del'], '" />
			</a>
			&nbsp;';

		echo '
			<a href="', $scripturl, '?action=profile;u=', $row['id_member'], '">
				<span style="color:', $row['online_color'], '">
					', $row['real_name'], '
				</span>
			</a>
			&nbsp;', timeformat($row['time']), '
		</div>
		<div style="padding: 4px;">
			', (wordwrap(parse_bbc(censorText($row['content'])), 34, "\n", true)), '
		</div>
	</div>';
	}

	echo '
	<div class="catbg centertext" style="font-weight:bold;line-height:3px;">
		&nbsp;
	</div>', $context['battle_display']['page'];

}

function template_battle_explore()
{
	global $context, $map, $txt, $user_info, $modSettings, $scripturl, $settings;

	echo '
	<div class="title_bar">
		<h3 class="titlebg">
			<span>
				', $txt['battle_explre'], '
			</span>
		</h3>
	</div>
	<table cellspacing="0" class="centertext" cellpadding="0" border="0">';

	if ($user_info['hp'] == 0)
		echo $txt['battle_deadplease'];

	if($user_info['energy'] > 2)
	{
		if(!empty($user_info['hp']))
		{
			foreach ($map as $row)
			{
				echo '
		<tr>';
				foreach ($row as $key => $tile)
				{
					echo '
			<td>
				<img src="', $settings['images_url'], '/battle/', $tile, '" border="0" usemap="#tile" width="50" height="50" alt="" />
					<map id="', $tile, '" name="tile">
						<area shape="rect" coords="', $modSettings['battle_map_coords'], '" href="', $scripturl, '?action=battle;sa=search;#battle_main" alt="" />
					</map>
			</td>';
				}
				echo '
		</tr>';
			}
		}

	}
	else
		echo $txt['battle_game_error_energy_explore'];

	echo '
	</table>';

}

function template_battle_monsters()
{
	global  $context, $settings,  $scripturl, $request, $txt;

	echo '
	<table width="100%" border="0" cellspacing="1" cellpadding="4" class="bordercolor centertext">
	       <tr>
			<td width="100%" class="centertext">
				<div class="title_bar">
					<h3 class="titlebg">
						<span>
							', $txt['battle_monsters'], '
						</span>
					</h3>
				</div>
		        </td>
		</tr>
	</table>
	<table width="98%" border="0" cellspacing="0" cellpadding="4" class="bordercolor centertext">';

	foreach ($context['get_monsters'] as $key => $row)
	{
		$class = $key % 2 == 0 ? 'windowbg' : 'windowbg2';

		echo '
		<tr>
			<td align="left" class="', $class, '" style="padding-left:2%;line-height:25px;width:30%">
				<img src="', $settings['images_url'], '/battle/monsters/', $row['img'], '" width="35" height="35" alt="" title="', $row['name'], '" />
				<span style="position:relative;bottom:12px;">
					', strlen($row['name']) > 25 ? substr($row['name'], 0, 22) . '...' : $row['name'], '
				</span>
			</td>
			<td align="left" class="', $class, ' centertext" style="padding-left:2%;line-height:25px;width:5%;">
				<img border="0" src="', $settings['images_url'], '/battle/bomb.png" alt="" style="vertical-align:middle;" />
			</td>
			<td align="left" class="', $class, ' centertext" style="line-height:25px;width:20%;vertical-align:middle;">
				<span style="position:relative;display:table-cell;height:25px">
					', $txt['battle_monStatsA'], ':&nbsp;&nbsp;
				</span>
				<span style="position:relative;display:table-cell;">
					', $row['atk'], '
				</span>
			</td>
			<td align="left" class="', $class, ' centertext" style="padding-left:2%;line-height:25px;width:5%">
				<img border="0" src="', $settings['images_url'], '/battle/bomb.png" alt="" style="vertical-align:middle;" />
			</td>
			<td align="left" class="', $class, ' centertext" style="line-height:25px;width:20%;vertical-align:middle;">
				<span style="position:relative;width:80%;display:table-cell;">
					', $txt['battle_range'], ':&nbsp;&nbsp;
				</span>
				<span style="position:relative;width:20%;display:table-cell;">
					', $row['mon_range'], '
				</span>
			</td>
			<td class="', $class, ' centertext" style="padding-right:2%;line-height:25px;width:5%">
				<img border="0" src="', $settings['images_url'], '/battle/shield.png" alt="" style="vertical-align:middle;margin-right:-10px" />
			</td>
			<td class="', $class, ' centertext" style="line-height:25px;width:15%;padding-right:2%;vertical-align:middle;text-align:left;">
				<span style="position:relative;display:table-cell;width:80%;">
					', $txt['battle_monStatsD'], ':&nbsp;&nbsp;
				</span>
				<span style="position:relative;display:table-cell;width:20%;">
					', $row['def'], '
				</span>
			</td>
		</tr>';
	}

	echo '
		<tr class="catbg">
			<td style="font-weight:bold;line-height:3px;position:relative;" colspan="7">
				&nbsp;
			</td>
		</tr>
	</table>', $context['battle_display']['page'];
}
?>
