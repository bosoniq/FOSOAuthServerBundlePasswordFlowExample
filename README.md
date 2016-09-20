FOSOAuthServerBundle Password Flow Example
==========================================

This is a bear bones example of how to use FOSOAuthServerBundle to provide basic security in a simple password flow. The example uses only the FOSOAuthServerBundle, a basic custom user provider and the Symfony Standard Edition. 


Setup 
-----

Firstly you need to create an Oauth client by visiting /createclient/ which is located in SecurityController.php

Next you will need to create a user who will be able to access the api. You can manually put this into the database table. 




Getting your access token
-------------------------

When you have your client and user copy and paste the required values into the URL below.

```
http://test/oauth_example/web/app_dev.php/oauth/v2/token?client_id=---CLIENT-DB-ID---_---CLIENT-SECRET---&client_secret=---CLIENT-SECRET---&grant_type=password&username=---USERNAME---&password=---PASSWORD---
```

Be careful not to forget the underscore between the CLIENT-DB-ID and the CLIENT-SECRET values. Also don't forget to change the root domain to that of your test domain. 

Once completed you should have a URL that looks similar to this.

```
http://test/oauth_example/web/app_dev.php/oauth/v2/token?client_id=1_k395ib14g4gg4wc8so8wgwkwk4cocwcgkkokkkko8s4gk04cw&client_secret=2hx6japotmas0go408oso400cock4w4c08wgww4g4o0s04g088&grant_type=password&username=admin&password=admin
```

and receive a response that looks like this.

```
{
  "access_token":"NTFlNmM2ZGY5ZmQzNWFjNTdkNDk1YmExZmNjMjZlYWQ2OWEwODQzZTRiNzE5OGU0MDVmY2QzMzIxMGNmMjFjNQ",
  "expires_in":3600,
  "token_type":"bearer",
  "scope":null,
  "refresh_token":"MDE5NTgxM2UwYzBlYmZkZjg3ZjM0MmM1Y2U5MTQ0NDI0YzEwMWJmMGI1NGI2MThiZmFmOThiYzhlMzc1Yzk4YQ"
}
```


From now on you can use the access_token to gain access to the secured /api/ area. Just include it in the http headers of each request by setting the `Authorization` header as follows.

```
Authorization: Bearer ---access_token---
```



Refreshing your token
---------------------

If you should need to refresh your token visit the following URL and include its value where required.

```
http://test/oauth_example/web/app_dev.php/oauth/v2/token?client_id=---CLIENT-DB-ID---_---CLIENT-SECRET---&client_secret=---CLIENT-SECRET---&grant_type=refresh_token&refresh_token=---REFRESH-TOKEN
```
