install:
	@docker run --rm --interactive --tty \
       --volume ./:/app \
       composer install
