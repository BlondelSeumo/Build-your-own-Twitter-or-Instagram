<?php 
# @*************************************************************************@
# @ @author Mansur Altamirov (Mansur_TL)									@
# @ @author_url 1: https://www.instagram.com/mansur_tl                      @
# @ @author_url 2: http://codecanyon.net/user/mansur_tl                     @
# @ @author_email: highexpresstore@gmail.com                                @
# @*************************************************************************@
# @ ColibriSM - The Ultimate Modern Social Media Sharing Platform           @
# @ Copyright (c) 21.03.2020 ColibriSM. All rights reserved.                @
# @*************************************************************************@

if (empty($cl["is_logged"])) {
	cl_redirect("guest");
}

else {

	require_once(cl_full_path("core/apps/ads/app_ctrl.php"));

	$cl["page_title"]   = cl_translate('Advertisement');
	$cl["page_desc"]    = $cl["config"]["description"];
	$cl["page_kw"]      = $cl["config"]["keywords"];
	$cl["pn"]           = "ads";
	$cl["sbr"]          = true;
	$cl["sbl"]          = true;
	$cl["app_statics"]  = array(
		"styles"        => array(
			cl_css_template("statics/css/apps/ads/style.master"),
			cl_css_template("statics/css/apps/ads/style.custom")
		)
	);

	if ($cl["theme_mode"] == "N") {
		array_push($cl["app_statics"]["styles"], cl_css_template("statics/css/apps/ads/style.dark"));
	}

	if ($cl['config']['advertising_system'] == 'off') {
		$cl["http_res"] = cl_template("ads/includes/systemoff");
	}
	else {
		$cl["page_tab"]     = fetch_or_get($_GET['page'], 'active');
		$cl["ads_ls"]       = array(); 
		$cl["active_ads"]   = cl_get_total_ads('active');   
		$cl["inactive_ads"] = cl_get_total_ads('inactive');   
		$cl["pending_ads"]  = cl_get_total_ads('pending');   

		if (in_array($cl["page_tab"], array('upsert', 'edit'))) {
			$ad_id              = fetch_or_get($_GET['ad_id'], 0);
			$ad_id              = (empty($ad_id)) ? $me['last_ad'] : $ad_id;
			$cl['countries_ls'] = array();
			$cl['ad_data']      = cl_get_or_create_orphan_ad($ad_id);
			$cl['ad_data']      = cl_ad_vue_preprocess($cl['ad_data']);

			if (empty($cl['ad_data'])) {
				cl_update_user_data($cl['me']['id'], array(
					"last_ad" => 0
				));

				cl_redirect('504');
			}

			else {
				foreach ($cl['countries'] as $k => $v) {
					$cl['countries_ls'][$k] = cl_translate($v);
				}
			}
		}

		else if($cl["page_tab"] == 'active') {
			$cl["ads_ls"] = cl_get_user_ads(array(
				'type' => 'active'
			));
		}

		else if($cl["page_tab"] == 'archive') {
			$cl["ads_ls"] = cl_get_user_ads(array(
				'type' => 'inactive'
			));
		}
		
		else if($cl["page_tab"] == 'pending') {
			$cl["ads_ls"] = cl_get_user_ads(array(
				'type' => 'pending'
			));
		}

		$cl["http_res"] = cl_template("ads/content");
	}
}
