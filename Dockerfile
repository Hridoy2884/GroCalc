# Set working directory
WORKDIR /var/www/html

# Copy Laravel files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Expose port
EXPOSE 80

# Start Apache and set DocumentRoot to Laravel's public folder
CMD ["/bin/sh", "-c", "echo 'DocumentRoot /var/www/html/public' >> /etc/apache2/sites-enabled/000-default.conf && apache2-foreground"]
