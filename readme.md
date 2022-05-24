# "AihBundle" Symfony pour Alpes Isère Habitat

**Ce bundle est à destination des développeurs d'Alpes Isère Habitat**, il ne présente aucuns intérêts pour d'autres applications que celles d'Alpes Isère Habitat.

## 🏁 Installation

Assurez-vous que Composer est installé globalement sur votre machine.

[Chapitre sur l'installation](https://getcomposer.org/doc/00-intro.md) de la documentation de Composer.

### Applications avec Symfony Flex

Ouvrez le terminal et tapez la commande suivante:

```console
$ composer require aih/aih-bundle
```

### Applications sans Symfony Flex

#### Step 1: Télécharger le bundle

Ouvrez le terminal et tapez la commande suivante:

```console
$ composer require aih/aih-bundle
```

#### Step 2: Ajouter le bundle à l'application

Ajouter le bundle à votre application Symfony en éditant le fichier `config/bundles.php` de votre application.

```php
// config/bundles.php

return [
    // ...
    Aih\AihBundle\AihBundle::class => ['all' => true],
];
```

## 🤝 Contribuer au projet

### 📃 Règles de codage

- Application des règles de [code standard Symfony](https://symfony.com/doc/current/contributing/code/standards.html)
- Application des standads [PSR-1, PSR-2, PSR-4 et PSR-12](https://www.php-fig.org/psr/)
- Indentation = 4 espaces

### 🔍 Merge Request

Les "Merges Requests" sont les bienvenues.

Pour les changements majeurs, veuillez en discuter avec le reste de l'équipe.

Merci de ne jamais travailler directement dans la branche Master.

### 🚴‍♂️ Tests et pipeline

Veuillez vous assurer de mettre à jour les tests le cas échéant ou d'en écrire de nouveaux pour couvrir vos ajouts.

Veuillez également vous assurer que vos modifications passent le pipeline d'intégration continue.

### 🏛 Code de Conduite

Dans l'intérêt de favoriser un environnement ouvert et accueillant, nous nous engageons à faire de la participation à ce projet une expérience exempte de harcèlement pour tout le monde, quel que soit le niveau d'expérience, le sexe, l'identité ou l'expression de genre, l'orientation sexuelle, le handicap, l'apparence personnelle, la taille physique, l'origine ethnique, l'âge, la religion ou la nationalité.