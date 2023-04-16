FROM php:7.4-apache

RUN echo "lCTF{flag}" > /etc/flag

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the contents of the current directory into the container at /var/www/html
COPY ./src/ /var/www/html

# Change the ownership of /var/www/html to www-data:www-data
RUN chown -R www-data:www-data /var/www/html

# Change the permissions of /var/www/html so that the ctf user cannot write to it
RUN chmod -R 555 /var/www/html
RUN ls -l /var/www/html


# Change Apache's default port to 5000
RUN sed -i 's/Listen 80/Listen 5000/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf


# Run Apache as the www-data user
USER www-data


# Start Apache
CMD ["apache2-foreground"]
