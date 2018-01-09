# Pokémon GO! Discord Bot for Lost/Won Arenas
This simple Bot will send lost and won arenas for a given team as a chat text wo a Discord hook.  
Currently only works with Rocketmap!

## How To Use:
Run `composer install --no-dev`.  
Run `composer dump-autoload`.
Ensure that you have write permissions in the `storage` folder.  

Copy `config/config.sample.php` to `config/config.php`  
Set `map_url` to the Rocketmap location like `https://example.com`  
Set the south west and north east corners of your scan area as Lat/Lon (`swLat`, `swLng`, `neLat`, `neLng`).  
Copy these values and insert them into `oSwLat`, `oSwLng` etc.  
Update the `webhook_url` to match your Discord Webhook Url.  

run `php app.php`