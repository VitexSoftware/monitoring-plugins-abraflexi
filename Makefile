repoversion=$(shell LANG=C aptitude show monitoring-plugins-abraflexi | grep Version: | awk '{print $$2}')
nextversion=$(shell echo $(repoversion) | perl -ne 'chomp; print join(".", splice(@{[split/\./,$$_]}, 0, -1), map {++$$_} pop @{[split/\./,$$_]}), "\n";')



all: fresh build

fresh:
	git pull

install:
	echo gdebi -y ../monitoring-plugins-abraflexi_*_all.deb
	
build:
	composer update

clean:
	rm -rf debian/monitoring-plugins-abraflexi
	rm -rf debian/*.log
	rm -f composer.lock
	rm -f ../monitoring-plugins-abraflexi_*_all.deb
	rm -rf vendor/*

doc:
	echo doc

test:
	echo phpunit --bootstrap tests/Bootstrap.php tests
	cd src ; php ./check_abraflexi.php  -s https://demo.flexibee.eu:443 -u winstrom -p winstrom -c demo && cd ..

deb:
	debuild -i -us -uc -b

release:
	echo Release v$(nextversion)
	dch -v $(nextversion) `git log -1 --pretty=%B | head -n 1`
	debuild -i -us -uc -b
	git commit -a -m "Release v$(nextversion)"
	git tag -a $(nextversion) -m "version $(nextversion)"


.PHONY : install
	
