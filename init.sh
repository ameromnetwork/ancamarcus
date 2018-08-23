./cachefix

composer install

bin/console cache:clear --env=dev
bin/console cache:clear --env=prod

yarn run encore dev
yarn run encore production
