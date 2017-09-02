all: fresh build

fresh:
	git pull

install: deb
	gdebi -y ../monitoring-plugins-flexibee_*_all.deb
	
build:
	composer update

clean:
	rm -rf debian/monitoring-plugins-flexibee
	rm -rf debian/*.log
	rm -rf vendor/*
	rm -f ../monitoring-plugins-flexibee_*_all.deb

doc:
	echo doc

test:
	phpunit --bootstrap tests/Bootstrap.php tests

deb:
	debuild -i -us -uc -b

.PHONY : install
	
