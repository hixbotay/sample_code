cd /your_folder
curl -O https://wordpress.org/latest.zip
unzip latest.zip 
cp -rf wordpress/* ../
rm -rf latest.zip 
rm -rf wordpress 
