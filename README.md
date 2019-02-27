# Blubrry PHP SDK

The SDK is based on Blubrry API version 2 and you can find the documentation [here](https://create.blubrry.com/resources/blubrry-api/)

# Supported Features

  - Media Hosting
  - Podcast Statistics
  - Social Medias

# Endpoints documentation
 - Media Hosting
---
Endpoint: listPrograms

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
Endpoint: listUnpublished

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
program_keyword | Specifies the program to list media files | string | no
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
Endpoint: publishMedia

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
program_keyword | Specifies the program to list media files | string | no
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
Endpoint: deleteMedia

Parameters  | Description | Type | Optional
----------  | ----------- | -    |--------
program_keyword | Specifies the program to list media files | string | no
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
### Installation

Blubrry SDK requires [PHP](https://www.php.net/) v7.2+ to run.

Clone the repository and make sure you import the file `Blubrry/autoload.php`

This SDK is open source with a [public repository](github.com/lucashillebrandt/blubrry-php-sdk) on GitHub.
