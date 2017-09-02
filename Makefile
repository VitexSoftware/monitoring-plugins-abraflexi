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
	phpunit --bootstrap tests/Bootstrap.php tests

deb:
	debuild -i -us -uc -b

.PHONY : install
	
