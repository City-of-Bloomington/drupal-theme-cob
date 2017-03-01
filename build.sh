#!/bin/bash
APPNAME=cob
DIR=`pwd`
BUILD=$DIR/build

declare -a dependencies=(node-sass node)
for i in "${dependencies[@]}"; do
    command -v $i > /dev/null 2>&1 || { echo "$i not installed" >&2; exit 1; }
done

if [ ! -d $BUILD ]
	then mkdir $BUILD
fi

# Compile the SASS
echo "Compiling SASS"
cd $DIR/css
./build_css.sh
cd $DIR

# The PHP code does not need to actually build anything.
# Just copy all the files into the build
echo "Preparing release"
rsync -rl --exclude-from=$DIR/buildignore --delete $DIR/ $BUILD/$APPNAME
cd $BUILD
tar czf $APPNAME.tar.gz $APPNAME
