Reproducer for [http://localhost:8080](https://github.com/symfony/symfony/issues/59205)

# How to set up

1. `cd docker`
2. `make`
3. *(after it is done you should be inside the container)*
4. make sure folder `var/log` is writeable
4. Open [http://localhost:8080](http://localhost:8080) in browser (it triggers the warning)
5. open related log file in `var/log`

It should produce log entries such as:

```
{"message":"Uncaught PHP Exception ErrorException: \"Warning: Cannot modify header information - headers already sent by (output started at /var/www/html/src/App/Controller/ShowLocalFileController.php:29)\" at Response.php line 322","context":{"exception":{"class":"ErrorException","message":"Warning: Cannot modify header information - headers already sent by (output started at /var/www/html/src/App/Controller/ShowLocalFileController.php:29)","code":0,"file":"/var/www/html/vendor/symfony/http-foundation/Response.php:322"}},"level":500,"level_name":"CRITICAL","channel":"request","datetime":"2025-06-04T11:56:38.706342+00:00","extra":{}}
```
