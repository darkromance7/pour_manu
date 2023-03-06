# WEB_7


## CI/CD 

## Stratégie des branches 


## Pipeline
Un unique pipeline pour gérer le front et le back. Il est divisé en 3 parties : 
- build 
- test 
- deploy 

### Ports 

#### prod 
- front : 8080  
- back : 
- bdd : 5432

#### dev 
- front : 
- back : 
- bdd : 
  
#### test 
- front : 
- back : 
- bdd : 

### Ansible 
#### roles 
- utilisateur : vérifie et installe, si nécessaire, les "users" pour l'exploitation du projet
- securité : vérifie et installe, si nécessaire, les outils de sécurisation pour la VM (firewall, etc)
- docker : vérifie et installe, si nécessaire, docker et docker engine sur une vm cible (avec les droits docker)