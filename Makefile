REQS := sassc
K := $(foreach r, ${REQS}, $(if $(shell command -v ${r} 2> /dev/null), '', $(error "${r} not installed")))

default: clean compile package

deps:

clean:
	rm -Rf build
	mkdir build
	rm -Rf css/.sass-cache

compile:
	cd css && sassc -t compact -m screen.scss screen.css

package:
	rsync -rl --exclude-from=buildignore --delete . build/cob
	cd build && tar czf cob.tar.gz cob
