<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Currency Converter</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Currency Converter</h1>
    <form method="get" action="index.php">
        <?php require("currencies.php"); ?>
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>
        
        <label for="from_currency">From:</label>
        
        <select id="from_currency" name="from_currency" required>
            <?php generateOptions();?>
        </select>

        <label for="to_currency">To:</label>
        <select id="to_currency" name="to_currency" required>
            <?php generateOptions();?>
        </select>

        <button type="submit" id="btn-submit">CONVERT</button>
    </form>
    <div id="result">
        <?php
            $apikey = "fca_live_HKpKiIDpC5eE1TMDIDq4x8HSnMcv7gOmijQdmwVq";
            $url = "https://api.freecurrencyapi.com/v1/latest";

            if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['amount']) && isset($_GET['from_currency']) && isset($_GET['to_currency']))
            {
                $amt = $_GET['amount'];
                $from = $_GET['from_currency'];
                $to = $_GET['to_currency'];
                
                $query = array("apikey"=>$apikey , "currencies" => $to , "base_currency" => $from);
                $htpp_query_string = http_build_query($query);
            
                $ch = curl_init();
                curl_setopt($ch , CURLOPT_URL, $url . "?" . $htpp_query_string);
                curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
                curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
                $headers = ["Content-type : Application/Json" , "Response : Application/Json"];
                curl_setopt($ch , CURLOPT_HTTPHEADER,$headers);
                $response = curl_exec($ch);
                if(curl_errno($ch))
                {
                    echo curl_error($ch);
                }
                else
                {
                    $decodedResponse = json_decode($response,1);
                    $ans = (float)$decodedResponse['data'][$to];
                    $ans = (float)$amt * $ans;
                    displayResult($amt, $from, $to, $ans);
                }
            }
            function displayResult(float $amt , string $from , string $to , float $ans):void
            {
                echo "<h3>Result</h3>";
                echo "<p>{$amt} {$from} = {$ans} {$to} </p>";
                echo file_get_contents("btn-reset.html");
            }


            
        ?>
    </div>
</body>
</html>