FROM phpmyadmin/phpmyadmin:latest

# Changer le port d'écoute d'Apache à 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf && \
    sed -i 's/:80>/:8080>/' /etc/apache2/sites-available/000-default.conf
