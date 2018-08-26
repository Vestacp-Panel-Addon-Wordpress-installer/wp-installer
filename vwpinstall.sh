#!/bin/bash
# Made by Sam Wattoo
# Copyright WapKiz Ltd
# Version: 1.1

if [ "x$(id -u)" != 'x0' ]; then
    echo 'Error: this script can only be executed by root'
    exit 1
fi

echo "Let's start..."

# Let's install the CSF Vesta UI!
function Vestawpinstaller() {
	echo "VestaCP Installing WordPress Installer...."
	
	mkdir /usr/local/vesta/web/list/wp
	wget https://raw.githubusercontent.com/Vestacp-Panel-Addon-Wordpress-installer/wp-installer/master/index.php -O /usr/local/vesta/web/list/wp/index.php
	wget https://raw.githubusercontent.com/Vestacp-Panel-Addon-Wordpress-installer/wp-installer/master/v-sam-create-wp -O /usr/local/vesta/bin/v-sam-create-wp
chmod 755 /usr/local/vesta/bin/v-sam-create-wp
	# Chmod files
	find /usr/local/vesta/web/list/wp -type d -exec chmod 755 {} \;
	find /usr/local/vesta/web/list/wp -type f -exec chmod 644 {} \;
	
	# Add the link to the panel.html file
	if grep -q 'wp' /usr/local/vesta/web/templates/admin/panel.html; then
		echo 'Already there.'
	else
		sed -i '/<div class="l-menu clearfix noselect">/a <div class="l-menu__item <?php if($TAB == "WP" ) echo "l-menu__item--active"; ?>"><a href="/list/wp/" target="_blank"><?=__("WP Install")?></a></div>' /usr/local/vesta/web/templates/admin/panel.html
	fi

	echo "Done! Check VestaCP!";
}

Vestawpinstaller();
