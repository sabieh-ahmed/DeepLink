# DeepLink

[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)

DeepLink is Laravel 5.3 Helper for various common tasks of your application just like.

  - Onesignal PushNotifications 
  - Cloudinary File Upload/File Remove
  - Event Broadcasting using SocketiO/Redis.




### Installation

DeepLink requires [PHP](https://nodejs.org/) v5.6+ to run.


Install the package

```sh
$ composer require deeplink/common 
```

Add DeepLinkServiceProvider to your providers array inside
config/app.php

```sh
    \DeepLink\Common\DeepLinkServiceProvider::class
```

Publish All vendor files
```sh
$ php artisan vendor:publish
```

All set to go.


use DeepLink Trait in your controller

```sh
use DeepLink\Common\Traits\DeepLinkHelper;

class UserController extends Controller
{



....

```

Provide neccessary config keys inside config/deeplink.php



### USAGE

Add Devices to user model.


```sh
use DeepLink\Common\Traits\DeepLinkHelper;

class UserController extends Controller
{

  
    public function login(Request $request)
    {
    ....
       
        if($request->has('device_token')
        {
            DeepLinkHelper::add_device($user,$request['device_token']);
        }
    
    
    }

....

```




Send Push Notification to user.


```sh
use DeepLink\Common\Traits\DeepLinkHelper;

class UserController extends Controller
{

  
    public function notify()
    {
    ....
        $user = User::find(1);
        DeepLinkHelper::notify_user($user,"Message","Title",["foo"=>"bar"]);
    }

....

```








Upload Files to Cloudinary


```sh
use DeepLink\Common\Traits\DeepLinkHelper;

class UserController extends Controller
{

  
    public function upload_file(Request $request)
    {
    ....
    
        if($request->has('image'))
        {
           $data = DeepLinkHelper::upload_file_cloudinary($request->file('image'));
           return $data['secure_url'];
        }
    }

....

```
