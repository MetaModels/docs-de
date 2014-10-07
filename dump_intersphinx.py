#!/usr/bin/env python

import sys
from sphinx.ext import intersphinx

import conf

class DummyApp(object):
    srcdir = "."

    def warn(self, msg):
        sys.stderr.write("%s\n" % msg)

def main():
    app = DummyApp()
    # baseurl to use
    uri = ""
    for invname in conf.intersphinx_mapping.keys():
        # inv = sys.argv[1]
        inv = conf.intersphinx_mapping[invname][0] + "objects.inv"
        inventory = intersphinx.fetch_inventory(app, uri, inv)
        for k in inventory.keys():
            print "Type: %s" % k
            for name, value in inventory[k].items():
                print "  %s -> '%s'" % (name, value[2])

    return 0

if __name__ == "__main__":
    sys.exit(main())
