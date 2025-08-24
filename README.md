# Internal Tools API

## Technologies
- Langage: [PHP]
- Framework: [Symfony] 
- Base de données: MySQL
- Port API: [8000] ( (configurable via .env ou docker-compose.yml))

## Quick Start

1. `docker-compose --profile mysql up -d`

2. [composer install]
3. [php -S localhost:8000 -t public] ou [symfony serve]
4. API disponible sur http://localhost:[8000]/api
5. Documentation: http://localhost:[8000]/[api/docs]

## Configuration
- Variables d'environnement: voir .env.example
- Configuration DB: [.env.example]



## Tests  
[php bin/phpunit] - Tests unitaires + intégration

## Architecture
    ### Jutification 

 - Symfony est un framework robuste et modulaire, très adapté aux API REST.

 - API Platform s’intègre parfaitement à Symfony et fournit beaucoup de fonctionnalités prêtes à l’emploi : documentation Swagger, pagination, filtres, validation, sérialisation, etc.

 - Cela permet d’itérer rapidement tout en gardant une base propre et extensible.

    ### Structure

 - Les entités (src/Entity) regroupent toute la logique métier (définition des ressources exposées par l’API).

 - API Platform génère automatiquement les endpoints REST en se basant sur ces entités + annotations/attributs.

 - Les filtres, validations et groupes de sérialisation sont configurés directement sur les entités.

 - Cela permet une structure simple et centralisée.