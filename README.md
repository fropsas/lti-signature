# LTI-signature

Package for signature of the Protocol request LTI

### Installation

```sh
$ composer require fropsas/lti-signature
```

### Usage
```php
<?php

use Fropsas\LTI\Tool\Tool;

$key = "your_key";
$secret = "your_secret";
$endpoint = "your_enpont";

$b64 = base64_encode($key.":::".$secret);
$outcomes = "your_link";
$outcomes .= "?b64=" . htmlentities($b64);

$data = array(
    "resource_link_id"          => "your_resource_link_id",
    "user_id"                   => "your_user_id",
    "lis_person_name_given"     => "your_name",
    "lis_person_name_family"    => "your_family",
    "lis_outcome_service_url"   => $outcomes,
    "lis_result_sourcedid"      => "your_lis_result_sourcedid"
);

$parms = Tool::signParameters($data, $endpoint, "POST", $key, $secret);

echo "<form method=\"POST\" action=\"$endpoint\" target=\"course_frame\">";
foreach ($parms as $parm => $key){
    echo "<input type=\"text\" name=\"$parm\" value=\"$key\">";
}
echo "<input type=\"submit\">";
echo "</form>";
?>

<iframe frameborder="0" name="course_frame"></iframe>
```

License
----

MIT