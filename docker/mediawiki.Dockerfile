# 1.35.6
FROM mediawiki@sha256:8341880b9444a75950ebe84442fb9db244d7f17ca5b1db84736c314cb9d73de2

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
