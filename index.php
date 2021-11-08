<!DOCTYPE html>

<html>

<head>

  <title>Pollfish s2s signature validator example</title>

</head>

<body>

<h1>Validate signature</h1>

<p>Url pattern is: <code>https://example.com?device_id=[[device_id]]]&amp;cpa=[[cpa]]&amp;timestamp=[[timstamp]]&amp;tx_id=[[tx_id]]&amp;request_uuid=[[request_uuid]]&amp;status=[[status]]&amp;signature=[[signature]]</code></p>

<?php $secret_key = "0c74c90a-f62e-40c5-813e-191d71a53034"; ?>

<p>Will check signature using HMAC-SHA1 and secret_key = <br><?php echo($secret_key) ?></b></p>

<?php

  $cpa = rawurldecode($_GET["cpa"]);

  $device_id = rawurldecode($_GET["device_id"]);

  $request_uuid = rawurldecode($_GET["request_uuid"]);

  $reward_name = rawurldecode($_GET["reward_name"]);

  $reward_value = rawurldecode($_GET["reward_value"]);

  $status = rawurldecode($_GET["status"]);

  $timestamp = rawurldecode($_GET["timestamp"]);

  $tx_id = rawurldecode($_GET["tx_id"]);

  $click_id = rawurldecode($_GET["click_id"]);

  $signature = rawurldecode($_GET["signature"]);

  $data = $cpa . ":" . $device_id;

  if (!empty($request_uuid)) { // only added when non-empty

    $data = $data . ":" . $request_uuid;

  }

  $data = $data . ":" . $reward_name . ":" . $reward_value . ":" . $status . ":" . $timestamp . ":" . $tx_id;

  $computed_signature = base64_encode(hash_hmac("sha1" , $data, $secret_key, true));

  $is_valid = $signature == $computed_signature;

?>

<p>cpa = <?php echo($cpa); ?></p>

<p>device_id = <?php echo($device_id); ?></p>

<p>request_uuid = <?php echo($request_uuid); ?></p>

<p>reward_name = <?php echo($reward_name); ?></p>

<p>$reward_value = <?php echo($reward_value); ?></p>

<p>status = <?php echo($status); ?></p>

<p>timestamp = <?php echo($timestamp); ?></p>

<p>tx_id = <?php echo($tx_id); ?></p>

<p>The signature is generated using the input string:<code><?php echo($data); ?></code></p>

<p>The generated signature is: <?php echo($computed_signature); ?></p>

<p>The URL signature is: <?php echo($signature); ?></p>

<p>The signature is valid: <?php echo($is_valid ? "true" : "false"); ?></p>

</body>

</html>
