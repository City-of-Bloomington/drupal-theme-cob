default: clean compile package

deps:

clean:
	rm -Rf build
	mkdir build

compile: deps

package:
	rsync -rl --exclude-from=buildignore --delete . build/cob
	cd build && tar czf cob.tar.gz cob
