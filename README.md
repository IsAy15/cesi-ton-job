# CESI Ton Job

CESI Ton Job est un projet en partenariat avec CESI école d’ingénieur, visant à aider les étudiants à trouver leur contrat professionnel, que ce soit un stage, une alternance, un CDI ou un CDD. Ce système permet aux pilotes de promotion de poster toutes les offres des partenaires de CESI, que les étudiants peuvent consulter et même candidater.

## Fonctionnalités

- **Consultation des offres** : Les étudiants peuvent consulter toutes les offres de contrats professionnels publiées par les pilotes de promotion ou l'administateur.
- **Candidature en ligne** : Les étudiants ont la possibilité de postuler directement aux offres qui les intéressent via la plateforme.
- **Facilité de recherche** : Les offres sont catégorisées et peuvent être filtrées pour une recherche plus efficace.
- **Mise en valeur de la collaboration avec le monde professionnel** : CESI Ton Job met en avant la collaboration entre CESI et ses partenaires professionnels, soulignant ainsi l'importance de l'enseignement en lien avec le monde du travail.
- **Consultation des entreprises** : 

## Technologies utilisées

- **Laravel** : Le projet est développé en utilisant le framework PHP Laravel pour sa robustesse et sa flexibilité.
- **MySQL** : La base de données MySQL est utilisée pour stocker les données des utilisateurs, des offres et des candidatures.
- **HTML/CSS/JavaScript** : Pour le développement de l'interface utilisateur.
- **NodeJs** : Pour créer des applications et d'outils côté serveur en JavaScript.

## Installation

1. Clonez ce dépôt sur votre machine locale en utilisant la commande `git clone`, en passant par `Github Desktop` ou votre IDE.
2. Assurez-vous d'avoir PHP, Composer, MySQL et Node.js installés sur votre machine et enregistrés dans vos variables d'execution système. Vous pouvez consulter les liens suivants pour vous aider à les installer : [Composer](https://getcomposer.org/) & [Node.js](https://nodejs.org/).
3. Copiez le `.env.example` et renommez le en `.env` puis configurez votre environnement de base de données dans le fichier `.env` en renseignant les informations de connexion appropriées.
4. Ouvrez un terminal dans le dossier du projet
5. Exécutez `composer install` pour installer les dépendances PHP.
6. Exécutez `npm install` pour installer les dépendances JavaScript.
7. Exécutez `.\dbreset.bat` pour créer et mettre à jour la base de données.
8. Exécutez `npm run dev` pour compiler les assets pour le développement.
9. Enfin, exécutez `php artisan serve` pour démarrer le serveur de développement de Laravel.

Note : en cas de problèmes, n'hésitez pas à contacter l'un des membres du groupe dès que possible.

### Utilitisation
Pour la connexion, voilà les codes par défaut :
Pour les utilisateurs : 
- email : user@ctj.fr   password : user
- email : user2@ctj.fr   password : user2
- email : user3@ctj.fr   password : user3

Pour les pilotes pilote : 
- email : pilote@ctj.fr      password : pilote
- email : pilote2@ctj.fr      password : pilote2
- email : pilote3@ctj.fr      password : pilote3
- email : pilote4@ctj.fr      password : pilote4
- email : pilote5@ctj.fr      password : pilote5

Pour l'administrateur : 
- email : admin@ctj.fr        password : admin 


## Auteurs

- [SOBHI Achraf](lien-vers-votre-site-ou-profil) 
- [Molina Adrien](lien-vers-votre-site-ou-profil) 
- [CELLIER HUGO](lien-vers-votre-site-ou-profil)
- [SIADOUX VALENTIN](lien-vers-votre-site-ou-profil)

## Licence

Ce projet est sous licence MIT.


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



