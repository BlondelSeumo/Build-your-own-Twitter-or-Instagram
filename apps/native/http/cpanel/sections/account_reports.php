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

require_once(cl_full_path("core/apps/cpanel/account_reports/app_ctrl.php"));

$cl['total_reports']   = cl_admin_get_total_profile_reports();
$cl['account_reports'] = cl_admin_get_profile_reports();
$cl['http_res']        = cl_template("cpanel/assets/account_reports/content");