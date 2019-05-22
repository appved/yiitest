#!/bin/bash 
envsubst < /etc/apache2/sites-available/000-default.template > /etc/apache2/sites-available/000-default.conf;
#cat /etc/apache2/envvars.template > /etc/apache2/envvars;
exec apache2-foreground