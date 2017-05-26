https://asciinema.org/a/82428?t=7

# Mongo Legacy Driver

## Connect

Default connectTimeoutMS equals to 60 seconds. If you have several servers in the seed list, total timeout would multiply
by the number of unresponsive servers.

When one of the seed hosts is not responding but there's a responsive one, connection takes 3 seconds by default  but
can be further limited by connectTimeoutMS. The order of hots in the seed list is not important.


# MongoDB Driver

Default timeout 10 seconds. If you have multiple unresponsive servers in the seed list, total timeout will not increase.

When one of the seed hosts is not responding but there's a responsive one, connection takes 3 seconds by default but
can be further limited by connectTimeoutMS. The order of hots in the seed list is not important.

## Connect

Defau