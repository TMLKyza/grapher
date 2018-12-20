BINPATH=/usr/bin
PM=apt
INSTALLPATH=~
SCRIPTPATH=${INSTALLPATH}/grapher/script.php
ALIAS=grapher

install: php 
	chmod +x grapher
	-cp -f grapher ${BINPATH}/
	mkdir ${INSTALLPATH}/.grapher
	-mv -f ../grapher/* ${INSTALLPATH}/.grapher
	rm -r ../grapher
php:${BINPATH}/php
	${PM} install php

