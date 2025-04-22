#!/bin/bash

HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)
setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX /var/www/html/var
setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX /var/www/html/var

if [ -z "$( ls -A '/var/www/html/vendor' )" ]; then
   cd /var/www/html
   composer update
   php app/console assets:install
   php app/console assetic:dump
   php app/console cache:clear --env=dev --no-debug
fi
