SASS := $(shell command -v node-sass 2> /dev/null)

default: clean compile package

deps:
ifndef SASS
	$(error "node-sass is not installed")
endif
	
clean:
	rm -Rf build
	mkdir build

compile: deps
	cd css && node-sass --output-style compact --source-map ./ screen.scss ./screen.css
	
package:
	rsync -rl --exclude-from=buildignore --delete . build/cob
	cd build && tar czf cob.tar.gz cob
