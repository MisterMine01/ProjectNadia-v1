<?php
include_once __DIR__ . "/../app/AppApi.php";
$test_token = new AppApi();
$tokenGood = isset(json_decode($test_token->testTempToken($_POST["APPID"], $_POST["tempToken"]), true)["Error"]);
if ($tokenGood) {
    if (isset($_POST["URI"])) { ?>
        <script>
            formLauncher(
                "POST",
                "<?php echo urldecode($_POST["URI"]) ?>", {
                    "Error": "tempToken not valid"
                }
            );
        </script>
<?php
    } else {
        echo "What are you doing bro ?";
    }
    die();
}

?>