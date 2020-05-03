# TOOLBOX API

The HTL-Toolbox API is the API for Login users in and giving them a Session Key for Apps to Access their Data

## Installation

Just put into the root directory of you Webserver

## Usage

To Access the Login API we use cURL in php but you can basicly use every programming language you like as long as its working with requests. (But you will most likley stick to php or some other web programming language like python with django)

```php

//Make sure you are using [https:] for save packet transfere

$curl = curl_init("https://api.philsoft.at/v1/login.php?api_key=[your_api_key]&email=[the email of the user you  to request the login]&password[the cleartext password the user has typed in]");

//Hashing the password is handeld by API itself

$result = curl_exec($curl);

setcookie("user_token", $result, time() + (86400 * 7), "/"); //Cokie is valid for 7 Days (86400 -> 1 Day)



```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

This API is, for the time beeing under privte licence you are not allowed to copy it.
