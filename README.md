# Duration app

## Project setup
### Clone the repository

```git clone git@github.com:jesuschristiani/scaler-beugro.git```

### Build the container

```docker-compose build --build-arg git_hub_token=[github oauth token]```

Github oauth token is necessary for composer. If you don't have one:

```https://github.com/settings/tokens/new?scopes=repo```

### Start the container

```docker-compose up```

### Enter the container console for manage symfony

```docker-compose exec php-fpm bash```

### Run install.sh

```bin/install.sh```

This script will install node_modules, php vendors, dump assets and set up the var directory acl restrictions.

## The web page

### Access the webpage
http://localhost:8081/

### Access the nelmio api doc
http://localhost:8081/api/doc