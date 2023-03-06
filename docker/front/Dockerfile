FROM nginx:1.22-alpine

# Récupère les artéfacts depuis le runner et les place dans le Dockerfile
RUN sudo rm -rf /usr/share/nginx/html/ 
COPY /builds/$CI_PROJECT_PATH/frontend/dist/spa/ /usr/share/nginx/html
# Récupère le fichier de conf de nginx pour le front 
# COPY nginx.conf /etc/nginx/nginx.conf
EXPOSE 80 
CMD ["nginx", "-g", "daemon off;"]