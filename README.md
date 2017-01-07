# DeepLink

[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)

DeepLink is Laravel 5.3 Helper for various common tasks of you application just like.

  - Onesignal PushNotifications 
  - Cloudinary File Upload/File Remove
  - Event Broadcasting using SocketiO/Redis.




### Installation

Dillinger requires [PHP](https://nodejs.org/) v5.6+ to run.


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

use DeepLinkHelper;

....

```

Provider neccessary config keys inside config/deeplink.php




