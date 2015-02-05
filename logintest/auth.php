<?php
//セッションの開始
session_start();

//設定
define ("LOGINID", "abcd");              //ログインID
define ("LOGINPASS", "1234");       //ログインPASS
define ("AUTHADMIN", "1");            //管理者セッション識別用

//権限チェック
if (! chk_auth())       //権限をチェックして
{
    disp_login();
    exit();                  //権限がなければログイン画面を表示
}

//---------------------------------------------------------------------------------------------------------
//ログイン画面
//---------------------------------------------------------------------------------------------------------

function disp_login()
{
    ?>
    <html>
    <head>
    <title></title>
    </head>
    <body>
    <h3>ログイン画面</h3>
    <form method = "post" action = " <?php echo $_SERVER["PHP_SELF"] ?>">
        <table border = "1">
        <tr>
        <td>ユーザーID</td>
        <td><input type = "text" name = "1_id"></td>
        </tr>
        <tr>
        <td>パスワード</td>
        <td><input type = "password" name = "1_pass"></td>
        </tr>
        </table>
    <input type ="submit" name = "sub" value = "ログイン">
    </form>
    </body>
    </html>
    <?php
}

//-------------------------------------------------------------------------------------------------------------
//ユーザー権限チェック
//-------------------------------------------------------------------------------------------------------------
function chk_auth()
{
    if (isset($_POST["1_id"]) and isset($_POST["1_pass"]))
    {
            if  ($_POST["1_id"] == LOGINID and $_POST["1_pass"] == LOGINPASS)
            {
                $_SESSION["auth"] = AUTHADMIN;
                return TRUE;
            }
             else
            {
                return FALSE;
            }
    }
    else
    {
            if (!isset($_SESSION["auth"]))
            {
                return FALSE;
            }
            else
            {
                if ($_SESSION["auth"] == AUTHADMIN)
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
     }
}
?>













































}