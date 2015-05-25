#! /bin/bash
cd models/propel
../../../../third_party/propel/propel/bin/propel model:build --verbose
../../../../third_party/propel/propel/bin/propel sql:build   --verbose --overwrite
