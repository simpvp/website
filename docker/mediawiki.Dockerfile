# 1.39.2
FROM mediawiki@sha256:682b2bf6f84fc86fb47265c1439ee42f3c8a4a1a03c1b448a921457b72c0748d

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
