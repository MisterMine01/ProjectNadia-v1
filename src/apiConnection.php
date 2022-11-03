<?php

include "site/php/PcJsApi.php";

$actual_link = explode(
    "/",
    (
        (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ?
        "https" :
        "http"
    ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
);
unset($actual_link[count($actual_link) - 1]);

$nadia = implode("/", $actual_link) . "/api/";

$pcjs = new PcJsApi($nadia);
include "api/private/Admin_app.php";

$data = $pcjs->getJsBySystem("GetTempToken", array(
    "appKey" => $admin_app["AppId"],
    "appSecret" => $admin_app["Secret_Key"]
));

$actual_link = implode("/", $actual_link) . $return;

?>
<form method="GET" action=<?php echo $nadia . "ihm/"; ?> id="formul">
    <input type="hidden" value=<?php echo "${purpose}" ?> name="Purpose">
    <input type="hidden" value=<?php echo "${data["appId"]}"; ?> name="APPID">
    <input type="hidden" value=<?php echo "${data["TempToken"]}"; ?> name="tempToken">
    <input type="hidden" value=<?php echo "${actual_link}"; ?> name="URI">
</form>
<script>
    document.getElementById("formul").submit();
</script>