# Use the base PHP Apache image
FROM php:8.1-apache

# Install the pdo_mysql extension for MySQL support
RUN docker-php-ext-install pdo_mysql
