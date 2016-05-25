tasks-symfony
=============

On initial run:
- set db settings in app/config/parameters.yml
- symfony bin/console doctrine:database:create && symfony bin/console doctrine:schema:create

To run the app:
- symfony bin/console server:run