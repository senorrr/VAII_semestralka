# Semestrálna práca VAII 2024/2025
Tento projekt predstavuje moju semestrálnu prácu z predmetu VAII (vývoj aplikácií pre internet a intranet). Vytvoril som webovú aplikáciu požičovne.
Projekt je založený na Frameworku [Vaiiko](https://github.com/thevajko/vaiicko).

## Návod na lokálne spustenie
Na spustenie webovej aplikácie je potrebený mať Docker [napríklad Docker Desktop](https://www.docker.com) a vývojové prostredie pre jazyk PHP [napríklad PhpStorm](https://www.jetbrains.com/phpstorm/).

## 1. Stiahnutie tohto repozitára
Napríklad pomocou príkazu ```git clone github.com/senorrr/VAII_semestralka```.

## 2. Spustenie 
1. Zapnutie Dockeru.
2. Otvorenie a spustenie súboru ```docker-compose.yml```.
3. Po úspešnom spustení by sa mali v Dockery v sekcii Containers objaviť nasledovné položky:
    - adminer - spravovanie databázy
    - mariadb - databáza
    - thevajko/vaii-web-server:main - stránka

## Problém s databázou
Ak by nastal problém s databázou tak v priečinku ```/docker/sql``` sa nachádzajú tabuľky aj s dátami, ktoré treba manuálne pridať do databázy.

