php_cs_checker:
	vendor/bin/php-cs-fixer fix --config=.php_cs.dist -v --dry-run --allow-risky=yes

php_cs_fixer:
	vendor/bin/php-cs-fixer fix --config=.php_cs.dist -v --allow-risky=yes

sniff:
	vendor/bin/phpcs

sniffer_fix:
	vendor/bin/phpcbf

cs: php_cs_checker sniff

fix_cs: php_cs_fixer sniffer_fix

stan:
	vendor/bin/phpstan analyse

security:
	vendor/bin/security-checker security:check composer.lock

ci: cs stan security
