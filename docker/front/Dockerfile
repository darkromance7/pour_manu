FROM nginx:stable-alpine

# Récupère les artéfacts depuis le runner et les place dans le Dockerfile 
COPY $CI_PROJECT_PATH/frontend/dist /usr/share/nginx/html
# Récupère le fichier de conf de nginx pour le front 
# COPY nginx.conf /etc/nginx/nginx.conf
EXPOSE 80 
CMD ["nginx", "-g", "daemon off;"]