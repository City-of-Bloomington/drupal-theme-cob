SASS := $(shell command -v sassc 2> /dev/null)

default: clean compile package

deps:
ifndef SASS
	$(error "sassc is not installed")
endif

clean:
	rm -Rf build
	mkdir build

compile: deps
	cd css && sassc -t compact -m screen.scss screen.css

package:
	rsync -rl --exclude-from=buildignore --delete . build/cob
	cd build && tar czf cob.tar.gz cob
