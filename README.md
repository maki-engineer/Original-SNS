ディレクトリを clone したら下のコマンドを入力すること！

<p>docker run --rm \ -u "$(id -u):$(id -g)" \ -v $(pwd):/var/www/html \ -w /var/www/html \ laravelsail/php81-composer:latest \ composer install --ignore-platform-reqs</p>

また、cloneしたらディレクトリにある .env.example ファイルの名前を .env に変更すること！