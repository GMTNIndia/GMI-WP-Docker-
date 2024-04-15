FROM wordpress:latest

# Adjust the file permissions
RUN chown -R www-data:www-data /var/www/html/wp-content/plugins

RUN chmod -R 777 /var/www/html/wp-content/plugins

# List and copy our custom plugins into the container
COPY gmindia-event-management /var/www/html/wp-content/plugins/

# Expose port 80 to the outside world
EXPOSE 80