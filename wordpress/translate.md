1. Go to php directory then download wp-cli by command
    curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
3. command 
> php C:\xampp\php\wp-cli.phar i18n make-pot .\wp-content\themes\flatsome-child
Theme stylesheet detected.
_the above command will get all php code with **<?= __('your text','flatsme-child')?>**_
4. Run url **<your domain>/debug/translate.php** to write to po file
