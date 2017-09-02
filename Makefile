all: fresh build

fresh:
	git pull

install:
	echo gdebi -y ../monitoring-plugins-flexibee_*_all.deb
	
build:
	composer update

clean:
	rm -rf debian/monitoring-plugins-flexibee
	rm -rf debian/*.log
	rm -f composer.lock
	rm -f ../monitoring-plugins-flexibee_*_all.deb
	#rm -rf vendor/*

doc:
	echo doc

test:
	echo phpunit --bootstrap tests/Bootstrap.php tests
	cd src ; ./check_flexibee.php  -s https://demo.flexibee.eu:443 -u winstrom -p winstrom -c demo && cd ..

deb:
	debuild -i -us -uc -b

.PHONY : install
	
