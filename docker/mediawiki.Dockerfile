# 1.39.5
FROM mediawiki@sha256:6c28318b5e6b71c80b23ba79d2937b0b26b8fb6a119d374b1648987686710581

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
