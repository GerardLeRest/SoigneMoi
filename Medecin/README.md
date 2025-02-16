# Installation de "Medecin"

## 1 Installation de Soignemoi-LWS

- voir le README de Soignemoi-LWS        

## 2 Configuration  de l'adresse IP du serveur

### 2.1  En local:

Changer les trois URL de types https par les adresses locales
(vous pouvez faire une recherche dans les fichier avec "https"), 

-------------------------------------------------
 .baseUrl("http://192.168.1.11/soignemoi-local/")
-------------------------------------------------

- créer un fichier app/res/xml/network_security_config.xml (autorisation http)
  
-------------------------------------------------
  <?xml version="1.0" encoding="utf-8"?>
  <network-security-config>
      <domain-config cleartextTrafficPermitted="true">
          <domain includeSubdomains="true">192.168.1.11</domain>
      </domain-config>
  </network-security-config>
-------------------------------------------------

- dans le fichier app/manifets/AndroidManifest.xml, ajouter:
  
-------------------------------------------------
    <application
		android:networkSecurityConfig="@xml/network_security_config"
		android:usesCleartextTraffic="true"
-------------------------------------------------

### 2.2 En hébergé:

- supprimer le fichier app/res/xml/network-security-config.xml et les lignes citées ci-dessus
- Vérifier que les adresses web soient "https://www.soignemoi.net/" dans les fichiers ActiviteAvis.java et ActivitePrescription.java
-------------------------------------------------
   .baseUrl("https://www.soignemoi.net/")
-------------------------------------------------

## 3 Installation de Medecin

- construire le fichier apk (Build -> Build App Bundles(s)/APK(s) -> Build APK(s)

- Récupérer le fichier apk dans le dossier "app/build/outputs/apk/debug/"

- Déplacer le fichier apk sur le téléphone
  (https://www.clubic.com/tutoriels/article-844849-1-comment-installer-fichier-apk-telephone-android.html ). 

- installer ce fichier.

- Il existe aussi l'outil Android Debug Bridge (adb) qui permet d'installer directement l'application sur le téléphone depuis l'ordinateur:
  
  * installation:
    sudo apt install adb
  * utilisation: 
    adb install app-debug.apk
