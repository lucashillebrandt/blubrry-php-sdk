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
programKeyword | Specifies the program | string | no
start       |  Specifies the number of results to return. The default is 20, 100 maximum | integer | yes
limit       |  Specifies the start position of returned results | integer | yes

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$start = 0;
$limit = 100;
$programKeyword = "my_program";

$api->mediaHosting()->listUnpublished($programKeyword, $limit, $start);
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
programKeyword | Specifies the program | string | no
mediafile       |  Specifies the media file to insert | string | no
publish       |  When true, the media file will be made publicly available. | boolean | no

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$programKeyword = "my_program";
$mediafile = "";
$publish = false;

$api->mediaHosting()->publishMedia($programKeyword, $mediafile, $publish);
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
programKeyword | Specifies the program | string | no
mediafile       |     Specifies the media file to delete | string | no

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$programKeyword = "my_program";
$mediafile = "";

$api->mediaHosting()->deleteMedia($programKeyword, $mediafile);
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
programKeyword | Specifies the program | string | no
url       | Individual URL to add to migration queue. | string | no
urls      | Multiple URLs separated by new lines to add to migration queue. | Array | yes

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$programKeyword = 'my_program';
$url = '';
$urls = ['', ''];

$api->mediaHosting()->addMigrateMediaUrl($programKeyword, $url, $urls);
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
programKeyword | Specifies the program | string | no
url       | Individual URL to add to migration queue. | string | no
urls      | Multiple URLs separated by new lines to add to migration queue. Send `null` or `[]` if you are using `url`) | Array | yes
ids      | One or more unique migrate IDs separated by commas. | Array | no

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$programKeyword = 'my_program';
$url = '';
$urls = ['', ''];
$ids = [123, 321, 3444, 3555];

$api->mediaHosting()->removeMigrateMediaUrl($programKeyword, $url, $urls, $ids);
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
programKeyword | Specifies the program | string | no
status | Only returns results with specific status. Status may be any one of `queued`, `downloading`, `completed`, `skipped`, `error` or empty string for no specific status | string | no
start       |  Specifies the number of results to return. The default is 20, 100 maximum | integer | no
limit       |  Specifies the start position of returned results | integer | no
ids      | One or more unique migrate IDs separated by commas. | Array | no

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$programKeyword = 'my_program';
$status = 'queued';
$start = 0;
$limit = 100;
$ids = [123, 321, 3444, 3555];

$api->mediaHosting()->migrateStatus($programKeyword, $status, $start, $limit, $ids);
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
programKeyword | Specifies the program | string | no
media_file | Specifies the media file to upload. | string | no


Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$programKeyword = 'my_program';
$media_file = '';

$api->mediaHosting()->uploadMedia($programKeyword, $media_file);
```

Example response:

``` json
{}
```
---
### - summary
Description: Gets Podcast Summary.

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
programKeyword | Specifies the program | string | no
month | Specific month to pull summary from. | string | yes
year | Specific year to pull summary from | string | yes

Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$programKeyword = 'my_program';
$media_file = '';

$api->podcastStatistics()->summary($programKeyword, $month, $year);
```

Example response:

``` json
{}
```

---
### - totals
Description: Get totals from a specific podcast, only available to professional statistics accounts.
Note: `start-date` and `end-date` range cannot exceed 45 days.

Parameters | Sub-Parameters | Description | Type | Optional
---------- | -------------- | ----------- | ---- | --------
programKeyword | - | Specifies the program | string | no
params | - | Array with the following parameters | Array | no
- | start-date | A start date for fetching Statistics data. Requests can specify a start date formatted as YYYY-MM-DD.  | string | no
- | end-date | End date for fetching Statistics data. The request can specify an end date formatted as YYYY-MM-DD. | string | yes
- | fields | Defaults to date, episode, downloads Selector specifying a subset of fields to include in the response. Fields include date (YYYY-MM-DD), episode (media file name), downloads. | string | yes
- | start |  Specifies the number of results to return. The default is 20, 100 maximum | integer | yes
- | limit |  Specifies the start position of returned results | integer | yes


Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$programKeyword = 'my_program';
$start_date = '';
$end_date = '';
$fields = '';
$start = '';
$limit = ;

$params = [
    'start-date' => $start_date,
    'end-date'   => $end_date,
    'fields'     => $fields,
    'start'      => $start,
    'limit'      => $limit,
];

$api->podcastStatistics()->totals($programKeyword, $params);
```

Example response:

``` json
{}
```
---
### - updateListing
Description: Updates the social listing.

Parameters  | Sub-Parameters |  Description | Type | Optional
----------  | -------------- |----------- | -    |--------
programKeyword | - |Specifies the program | string | no
params | - | Array with the following parameters | Array | no
-| title | Title of the podcast episode.  | string | no
-| date | Date in RFC 2822 format | string | no
-| mediaUrl | Podcast enclosure “url” value, must be a complete URL with protocol schema. | string | no
-| filesize | File size in bytes, this is the Podcast enclosure "length". Value should not be formatted, should not include commas.| string | no
-| feedUrl | The RSS feed URL for the specified podcast. Do not try to insert with the podcast episode data, will be used for a different purpose. | string | yes
-| guid | RSS item guid value. If not specified, the media-url is used as the guid value. | string | yes
-| subtitle | iTunes Subtitle of podcast episode, or the first 255 characters of blog post | string | yes
-| duration | iTunes duration, specified in hh:mm:ss | string | yes
-| explicit | iTunes explicit value, values can be one of: `yes`, `no`, `clean`. Default set to `no` | string | yes
-| link | RSS item “link” value, should be complete URL to the blog post or page associated with the podcast episode. | string | yes
-| image | RSS item "itunes:image" value or the episode’s official image in square coverart form, should be a complete URL to the episode specific image.| string | yes


Example request:

``` php
<?php
require_once 'Blubrry/autoload.php';

$api = new \Blubrry\REST\API();

$programKeyword = 'my_program';

$params = [
    'feed-url'  => $feedUrl,
    'title'     => $title,
    'date'      => $date,
    'guid'      => $guid,
    'media-url' => $mediaUrl,
    'subtitle'  => $subtitle,
    'duration'  => $duration,
    'filesize'  => $filesize,
    'explicit'  => $explicit,
    'link'      => $link,
    'image'     => $image,
];

$api->social()->updateListing($programKeyword, $params);
```

Example response:

``` json
{}
```
### Installation



Blubrry SDK requires [PHP](https://www.php.net/) v7.2+ to run.

Clone the repository and make sure you import the file `Blubrry/autoload.php`

This SDK is open source with a [public repository](github.com/lucashillebrandt/blubrry-php-sdk) on GitHub.
