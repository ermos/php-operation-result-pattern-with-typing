composer:
	@docker run --rm --interactive --tty \
       --volume ./:/app \
       composer $(cmd)

composer-up:
	@make composer cmd=up