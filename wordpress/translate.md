1. Go to php directory then download wp-cli by command

>curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
>
2. Go to root wordpress folder then type below command 
> php C:\xampp\php\wp-cli.phar i18n make-pot .\wp-content\themes\flatsome-child
> 
_the above command will get all php code with **<?= __('your text','flatsme-child')?>**_

3. Run url **your domain/debug/translate.php** to write to po file
