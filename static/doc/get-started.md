
# Automate

Automate allows you to automate your deployments to remote Linux servers simply.
You can use Automate from your workstation or through an integration server like Travis or Gitlab-ci.

# Installation

You can download the latest version of Automate with the following command:

```bash
curl -LSs https://automatephp.github.io/installer.php | php
```

The command will verify your PHP settings and launch the download in the current directory.

You will then be able to update Automate simply with the following command:

```bash
php automate.phar update
```

# Creating your configuration file

Foremost, you have to create a configuration file for Automate.
This file is usually located at the root of your project. The name of this file must be `.automate.yml`.

Here is an example file:

```YAML
repository: git@github.com:symfony/symfony-demo.git
platforms:
    development:
        default_branch: dev
        max_releases: 3
        servers:
            dev-exemple-front-01:
                host: dev.exemple.com
                user: automate
                password: %dev_password%
                path: /home/wwwroot/
                port: 22
    production:
        default_branch: master
        max_releases: 3
        servers:
            prod-exemple-front-01:
                host: prod-1.exemple.com
                user: automate
                password: %prod_password%
                path: /home/wwwroot/
            prod-exemple-front-02:
                host: prod-2.exemple.com
                user: automate
                ssh_key: /path/to/key
                path: /home/wwwroot/
             prod-exemple-front-03:
                host: prod-3.exemple.com
                user: automate
                ssh_key: /path/to/key
                password: %passphrase%
                path: /home/wwwroot/
shared_files:
    - app/config/parameters.yml
shared_folders:
    - app/data
pre_deploy:
    - "php -v"
on_deploy:
    - "composer install"
    - "setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX var"
post_deploy:
    - "php bin/console doctrine:schema:update --force"
    only: eddv-exemple-front-01                     
    - "php bin/console doctrine:cache:clear-result"
```

## Configuration

### repository

```YAML
repository: git@github.com:symfony/symfony-demo.git
```

Address of your git repository. If you use a repository in https you can use a variable with the notation %variable_name% for the password like this:

```YAML
repository: https://user:%git_password%@exemple.com
```


### platforms

List of platforms.

You can configure several platforms ; a project must have at least one platform.

```YAML
platforms:
    production:
        default_branch: master # The default branch to be launched if no branch is specified during the deployement
        max_releases: 1        # The number of releases to be kept on remote servers.
        servers:
            prod-exemple-front-01:
                host: prod-1.exemple.com   # The domain name or the server's IP
                user: automate             # The SSH user to be used for the deployment
                password: %prod_password%  # Read more below in "The SSH password" section
                path: /home/wwwroot/       # The path on the remote server
                port: 22                   # The SSH port (default:22)    
            prod-exemple-front-02:
                host: prod-2.exemple.com
                user: automate
                ssh_key: /keys/private     # A file path to private key
                password: %passphrase%     # An optional passphrase
                path: /home/wwwroot/
```

It's possible to authenticate on the server with a password or with a private key. For the latter, you must define a path to the private key file and an optional passphrase (password) as the example above describes.

You can use a variable with the notation %variable_name% 
If one variable is detected Automate will search for the value in an environment variable « AUTOMATE__variable_name ».
If the environment variable doesn't exist, Automate will ask to you to provide your password upon each deployment through in your terminal.

### shared_files

The list of files to be shared with releases.
For example, some parameters files,..

```YAML
shared_files:
    - app/config/parameters.yml
    - app/config/config.yml
    - ...
```

### shared_folders

The list of folders to be shared between releases.
For example some uploaded pictures,..

```YAML
shared_files:
    - app/data
    - ...
```

### pre_deploy

The list of commands to be launched on remote servers **after downloading sources** and **before** setting up shared folders and files.

### on_deploy

The list of commands to be launched on remote servers **before deployment**.

### post_deploy

The list of commands to be launched on remote servers **after deployment**.

**Option**: Possibility to execute only one command just to one remote server with:

```YAML
post_deploy:
    - "php bin/console doctrine:cache:clear-result"
       only: eddv-exemple-front-01                     
```

# Server Configuration

Automate will create the following directory structure to the remote server:

```BASH
/your/project/path
|--releases
|  |--20160513120631
|  |  |--config
|  |  |  |--parameters.yml --> /your/project/path/shared/app/config/parameters.yml
|
|--shared_files
|  |  |--config
|  |  |  |--parameters.yml #the real file is here
|
|--current -> /your/project/path/releases/20150513120631
```

This is the schema of all your project's architecture
You have to target your domain name inside the folder `/your/project/path/current/.`
