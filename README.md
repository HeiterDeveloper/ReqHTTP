# ReqHTTP


PHP class to handle HTTP requests

```php
ReqHTTP::init()->checkGet(array("param1"=>"value"))->checkPost(array("param2"=>"value"))->isPost()->exec($class_object, "method_name");

//OR

ReqHTTP::init()->checkGet("param1")->checkPost("param2")->isPost()->exec($class_object, "method_name");

```
