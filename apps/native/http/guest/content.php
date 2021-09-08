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

if (not_empty($cl["is_logged"])) {
	cl_redirect("home");
}

$cl["app_statics"] = array(
	"styles" => array(
		cl_css_template("statics/css/apps/guest/style.master"),
		cl_css_template("statics/css/apps/guest/style.mq"),
		cl_css_template("statics/css/apps/guest/style.custom")
	)
);

if ($cl["theme_mode"] == "N") {
	array_push($cl["app_statics"]["styles"], cl_css_template("statics/css/apps/guest/style.dark"));
}

$cl["page_title"] = $cl["config"]["title"];
$cl["page_desc"]  = $cl["config"]["description"];
$cl["page_kw"]    = $cl["config"]["keywords"];
$cl["pn"]         = "guest";
$cl['em_code']    = ((not_empty($_GET['em_code']) && cl_verify_emcode($_GET['em_code'])) ? cl_text_secure($_GET['em_code']) : null);
$cl["sbr"]        = false;
$cl["sbl"]        = false;
$cl["http_res"]   = cl_template("guest/content");
