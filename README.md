# ![left 100%](https://raw.githubusercontent.com/thierry-laval/archives/master/images/logo-portfolio.png)

## Auteur

👤 &nbsp; **Thierry LAVAL** [🇫🇷 Contactez moi 🇬🇧](<contact@thierrylaval.dev>)

* Github: [@Thierry Laval](https://github.com/thierry-laval)
* LinkedIn: [@Thierry Laval](https://www.linkedin.com/in/thierry-laval)
* Visitez ==> 🏠 [Site Web](https://thierrylaval.dev)

***

### 📎 Projet - Module Perfex Simple iCal Export (v1.0)

![left 100%](https://raw.githubusercontent.com/thierry-laval/archives/master/images/perfex-simple_ical.png?raw=true)

_`Projet finalisé le 09/05/2024`_

***

Ce module pour Perfex CRM permet d'exporter les événements de votre calendrier vers des applications externes comme **Apple Calendar (Mac/iPhone)**, Google Calendar ou Outlook. Il génère un flux iCal (`.ics`) dynamique, sécurisé et optimisé pour garantir une synchronisation fluide sans décalage horaire.

### Fonctionnalités principales

* **Synchronisation Apple Calendar optimisée** : Gestion des headers TTL et Refresh pour une mise à jour toutes les 5 minutes.
* **Sécurité par Token** : Accès au flux protégé par un jeton unique généré dynamiquement.
* **Filtrage Intelligent** : Possibilité de définir des dates de début et de fin pour limiter les données exportées.
* **Conformité RFC 5545** : Échappement automatique des caractères spéciaux (virgules, points-virgules) pour éviter les erreurs de lecture.
* **Outils de Diagnostic** : Interface de test intégrée pour visualiser le flux brut et vérifier la validité du calendrier.
* **Format Local** : Dates exportées sans suffixe UTC pour éviter les erreurs de fuseau horaire sur les appareils iOS/macOS.

#### 🔧 Installation

1. Téléchargez le dépôt, renommez le dossier en `simple_ical` et placez-le dans le répertoire `/modules/` de votre installation Perfex CRM.
2. Allez dans **Configuration → Modules** dans votre interface Perfex.
3. Activez le module **"Simple iCal Export"**.
4. Un nouveau menu **"iCal Export"** apparaît dans votre barre latérale.

### 🚀 Mise en route

#### Configuration du flux

1. Accédez à la page du module.
2. (Optionnel) Saisissez vos dates de filtrage et enregistrez.
3. Cliquez sur **"Diagnostic"** pour confirmer que le flux est prêt.
4. Cliquez sur **"Copier"** pour récupérer votre URL sécurisée. 

#### Synchronisation (Exemple Apple)

* Sur iPhone : Réglages > Calendrier > Comptes > Ajouter un compte > Autre > Ajouter un calendrier avec abonnement.
* Collez l'URL et réglez l'actualisation sur 5 minutes.

### 💡 Cas d’usage

**Visualisation immédiate du flux :**
Le bouton **"Tester"** affiche directement dans votre administration le contenu du fichier `.ics`. Cela permet de vérifier instantanément si vos données sont correctement formatées et si les filtres de dates sont appliqués.

#### 🛡️ Note sur la sécurité

* Le flux utilise un contrôleur public (`Simple_ical_feed`) afin de permettre aux serveurs d'Apple et Google de lire les données sans être bloqués par l'authentification Admin de Perfex.
* L'accès est verrouillé par un `token` stocké en base de données. Sans ce token dans l'URL, le serveur renvoie une erreur 403.
* Toutes les descriptions sont nettoyées via `strip_tags` pour éviter l'injection de code malveillant dans votre application de calendrier.

#### 📦  &nbsp; Utilisé dans ce projet

| Langages        | et Applications    |
| :-------------: |:--------------:    |
| PHP (CodeIgniter) | Visual Studio Code |
| iCalendar (RFC 5545) | Git / GitHub       |
| Javascript (Vanilla) | Perfex CRM |

### 📝 Documentation & Aide

* **Bouton Diagnostic** : Vérifie la présence de la table `tblevents` et la structure du flux.
* **Bouton Télécharger** : Permet de récupérer manuellement le fichier `.ics` pour une importation ponctuelle.
* **Note sur le rafraîchissement** : Bien que le flux demande une mise à jour toutes les 5 minutes, le délai final dépend des réglages de l'application cliente (Apple, Google, etc.).

## 📝  License

Ce projet est sous licence [MIT](LICENCE).

[Voir mon travail](https://github.com/thierry-laval)

[Créer un bon template](https://github.com/thierry-laval/P22-template-pour-un-readme)

***

### &hearts;&nbsp;&nbsp;&nbsp;&nbsp;Love Markdown

Donnez une ⭐️ &nbsp; si ce projet vous a plu !

<span style="font-family:Papyrus; font-size:4em;">FAN DE GITHUB !</span>

<!--[This is an image](https://myoctocat.com/)-->

<img src="EMPLACEMENT DE L IMAGE.png" height="300" />

**[⬆ Retour en haut](#auteur)**
