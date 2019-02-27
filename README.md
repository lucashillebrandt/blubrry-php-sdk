# Blubrry PHP SDK

The SDK is based on Blubrry API version 2 and you can find the documentation [here](https://create.blubrry.com/resources/blubrry-api/)

# Supported Features

  - Media Hosting
  - Podcast Statistics
  - Social Medias

# Authenticating Users

The Blubrry API has OAuth2.0 authentication system.

In way to keep using that authentication system, you will have to implement some thing to make that work. The first step is to contat the [Blubrry Support Team](https://www.blubrry.com/contact/) and ask them for user credentials to use their API.

After that, you will have to add a button into your Website with a redirect to a link like this:

```
https://api.blubrry.com/oauth2/authorize?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri
```

Where:

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
client_id    |  The client_id that the customer recieved from Blubrry Support Team. | string | no
redirect_uri |  The url that the user should be redirected after login into the Blubrry account. | string | no

This will return a link like this:

```
https://$redirect_uri/code=767a88a9576asdasdasda123123cfd
```

Then, you will have to retrieve a Refresh token for this user:

### - getRefresh
Description: List Programs from Blubrry.

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
code       |  Response code from User login at Blubrry | string | no
redirect_uri |  The url that the user should be redirected after login into the Blubrry account | integer | yes

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$code = '767a88a9576asdasdasda123123cfd';
$redirect_uri = 'https://$redirect_uri/';

$api->auth()->getRefresh($code, $redirect_uri);
```

Example response: 

``` json
{"access_token":"3b636a92ee50a8f17543f6a531b27e55d525bcd1", "expires_in":3600, "token_type":"bearer", "scope":null, "refresh_token":"55b01e60a74e45b3c66032627dcbc0dddd0bbd6a"}
```

And then, you will use the `access_token` to be able to do requests to the another API endpoits.

The `access_token` expires in one hour, you will need to save the `refresh_token` locally and send a request to the endpoint `refreshToken` to retrieve a new `access_token` without need of the user loggin into the Blubrry account.

### - refreshToken

- TBI

# Endpoints

### - listPrograms
Description: List Programs from Blubrry.

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
start       |  Specifies the number of results to return. The default is 20, 100 maximum | integer | yes
limit       |  Specifies the start position of returned results | integer | yes

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$start = 0;
$limit = 100;

$api->mediaHosting()->listPrograms($limit, $start);
```

Example response: 

``` json
{}
```
---
### - listUnpublished
Description: List umpublished Media from Blubrry.

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
program_keyword | Specifies the program | string | no
start       |  Specifies the number of results to return. The default is 20, 100 maximum | integer | yes
limit       |  Specifies the start position of returned results | integer | yes

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$start = 0;
$limit = 100;
$program_keyword = "my_program";

$api->mediaHosting()->listUnpublished($program_keyword, $limit, $start);
```

Example response:

``` json
{}
```
---
### - publishMedia
Description: Publish Media into Blubrry.

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
program_keyword | Specifies the program | string | no
mediafile       |  Specifies the media file to insert | string | no
publish       |  When true, the media file will be made publicly available. | boolean | no

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$program_keyword = "my_program";
$mediafile = "";
$publish = false;

$api->mediaHosting()->publishMedia($program_keyword, $mediafile, $publish);
```

Example response:

``` json
{}
```
---
### - deleteMedia
Description: Delete media from Blubrry

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
program_keyword | Specifies the program | string | no
mediafile       |     Specifies the media file to delete | string | no

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$program_keyword = "my_program";
$mediafile = "";

$api->mediaHosting()->deleteMedia($program_keyword, $mediafile);
```

Example response:

``` json
{}
```
---
### - addMigrateMediaUrl
Description: Adds media URLs to the migration queue.

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
program_keyword | Specifies the program | string | no
url       | Individual URL to add to migration queue. | string | no
urls      | Multiple URLs separated by new lines to add to migration queue. | Array | yes

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$program_keyword = 'my_program';
$url = '';
$urls = ['', ''];

$api->mediaHosting()->addMigrateMediaUrl($program_keyword, $url, $urls);
```

Example response:

``` json
{}
```
---
### - removeMigrateMediaUrl
Description: Remove media URLs from the migration queue.

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
program_keyword | Specifies the program | string | no
url       | Individual URL to add to migration queue. | string | no
urls      | Multiple URLs separated by new lines to add to migration queue. Send `null` or `[]` if you are using `url`) | Array | yes
ids      | One or more unique migrate IDs separated by commas. | Array | no

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$program_keyword = 'my_program';
$url = '';
$urls = ['', ''];
$ids = [123, 321, 3444, 3555];

$api->mediaHosting()->removeMigrateMediaUrl($program_keyword, $url, $urls, $ids);
```

Example response:

``` json
{}
```
---
### - migrateStatus
Description: Makes the uploaded media file publicly available.

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
program_keyword | Specifies the program | string | no
status | Only returns results with specific status. Status may be any one of `queued`, `downloading`, `completed`, `skipped`, `error` or empty string for no specific status | string | no
start       |  Specifies the number of results to return. The default is 20, 100 maximum | integer | no
limit       |  Specifies the start position of returned results | integer | no
ids      | One or more unique migrate IDs separated by commas. | Array | no

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$program_keyword = 'my_program';
$status = 'queued';
$start = 0;
$limit = 100;
$ids = [123, 321, 3444, 3555];

$api->mediaHosting()->migrateStatus($program_keyword, $status, $start, $limit, $ids);
```

Example response:

``` json
{}
```
---
### - uploadMedia
Description: Uploads a media file to the server.

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
program_keyword | Specifies the program | string | no
media_file | Specifies the media file to upload. | string | no


Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$program_keyword = 'my_program';
$media_file = '';

$api->mediaHosting()->uploadMedia($program_keyword, $media_file);
```

Example response:

``` json
{}
```
### Installation



Blubrry SDK requires [PHP](https://www.php.net/) v7.2+ to run.

Clone the repository and make sure you import the file `Blubrry/autoload.php`

This SDK is open source with a [public repository](github.com/lucashillebrandt/blubrry-php-sdk) on GitHub.
