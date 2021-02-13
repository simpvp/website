FROM debian@sha256:85c4668abb4f26e913152ba8fd04fca5f1c2345d3e2653855e6bb0acf461ed50 as phpbb

RUN apt-get update && apt-get install -y wget ca-certificates lbzip2
RUN wget https://download.phpbb.com/pub/release/3.3/3.3.0/phpBB-3.3.0.tar.bz2
RUN echo 'a6234ac9dcf9086c025ece29a0a235f997a92bb9a994eff0ddcf8917e841262f  phpBB-3.3.0.tar.bz2' | sha256sum -c -
RUN tar -xf *bz2

# 1.32
FROM mediawiki@sha256:349aeb8014b58754ac25ea022ee0c26e399ce18d756ecada7579c3f39d52c5a1

# For image resizing support (for thumbnails)
# Taken from https://github.com/docker-library/docs/blob/master/php/README.md
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-install -j$(nproc) iconv \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) gd

COPY --from=phpbb /phpBB3 /phpBB3
