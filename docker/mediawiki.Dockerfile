# 1.39.8
FROM mediawiki@sha256:c5cc41284a2386653f0d77a765d1eba98107de39b839f002ded067768a18aa61

# For image resizing support (for thumbnails)
# Taken from https://github.com/docker-library/docs/blob/master/php/README.md
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-install -j$(nproc) iconv \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

RUN apt-get update && apt-get install -y sendmail
